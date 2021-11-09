<?php

namespace App\Http\Controllers;

use App\Models\BorrowingBook;
use App\Models\BorrowingStatus;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\BorrowingBookRequest;
use CreateBorrowingStatus;

class BorrowingBookController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['store', 'returnBook', 'index']]);
    }

    //user
    public function index()
    {
        $payload = auth()->payload();
        $user_id = $payload->get('sub');

        $list = BorrowingBook::where('borrower_id', $user_id)->get();
        return response()->json([
            'status' => 'ok',
            'user_id' => $user_id,
            'data' => $list
        ]);
    }

    //admin
    public function store(BorrowingBookRequest $request)
    {
        $check = $this->checkBorrowing($request->get('book_id'))->getData()->borrowing;

        if ($check) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Hiện tại sách đang được mượn',
            ], 422);
        }
        $create_bb = BorrowingBook::create(array_merge(
            $request->only('book_id', 'from_date', 'promissory_date', 'borrower_id'),
            ['status_id' => 1]
        ));
        return response()->json([
            'status' => 'ok',
            'data' => $create_bb,
        ]);
    }

    public function destroy($borrowing_book_id)
    {
        $check = BorrowingBook::where('borrowing_book_id', $borrowing_book_id)->count();
        if ($check == 0 ) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Id mượn sách không tồn tại'
            ], 400);
        }

        $check_borrowing_book_delete = BorrowingBook::where('borrowing_book_id', $borrowing_book_id)->delete();
        if ($check_borrowing_book_delete == 0 ) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Xoá lượt mượn sách thất bại'
            ], 400);
        }
        
        return response()->json([
            'status' => 'ok',
            'messenger' => 'Xoá lượt mượn sách thành công'
        ], 200);

    }


    // user,admin
    public function checkBorrowing($book_id)
    {
        $checkBorrowing = BorrowingBook::where([
            ['status_id', '=', 1],
            ['book_id', '=', $book_id],
        ])->count();

        return response()->json([
            'status' => 'ok',
            'borrowing' => $checkBorrowing > 0,
        ]);
    }

    public function returnBook($borrowing_book_id)
    {
        $checkBorrowing = BorrowingBook::where([
            ['borrowing_book_id', '=', $borrowing_book_id], ['status_id', 2]
        ])->count();

        if ($checkBorrowing == 1) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Trả sách thất bại'
            ], 422);
        }

        $check = BorrowingBook::where([
            ['borrowing_book_id', '=', $borrowing_book_id]
        ])->update(['status_id' => 2, 'to_date' => date('Y/m/d h:i:s', time())]);

        if (!$check) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Trả sách thất bại'
            ], 422);
        }

        return response()->json([
            'status' => 'ok',
            'messenger' => 'Trả sách thành công'
        ], 200);
    }

    // danh sách ng mượn
    public function getBorrower(Request $request)
    {
        $list = BorrowingBook::filter($request->all());
        return response()->json([
            $list,
        ]);
    }
}
