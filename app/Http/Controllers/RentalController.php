<?php

namespace App\Http\Controllers;

use App\Models\Rental;

use Illuminate\Http\Request;
use App\Http\Requests\RentalRequest;

class RentalController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:api', ['only' => ['store', 'returnBook', 'index']]);
    }

    //get the history rental by current user
    public function getHistoryRentalByCurrentUser()
    {
        $payload = auth()->payload();
        $user_id = $payload->get('sub');

        $rentals = Rental::where('user_id', $user_id)->get();
        return $rentals;
    }

    //admin: create an rental
    public function store(RentalRequest $request)
    {
        $check = $this->checkBorrowing($request->get('book_id'))->getData()->borrowing;

        // if ($check) {
        //     return response()->json([
        //         'status' => 'error',
        //         'messenger' => 'Hiện tại sách đang được mượn',
        //     ], 422);
        // }
        $create_bb = Rental::create(array_merge(
            $request->only('book_id', 'rental_date', 'promissory_date', 'user_id'),
            //['status_id' => 1]
        ));
        return response()->json([
            'status' => 'ok',
            'data' => $create_bb,
        ]);
    }
    
    public function destroy($id)
    {
        $check = Rental::where('_id', $id)->count();
        if ($check == 0 ) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Id mượn sách không tồn tại'
            ], 400);
        }

        $check_borrowing_book_delete = Rental::where('_id', $id)->delete();
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
        $checkBorrowing = Rental::where('book_id', '=', $book_id)->whereNull('return_date')->count();

        return response()->json([
            'status' => 'ok',
            'borrowing' => $checkBorrowing > 0,
        ]);
    }

    public function returnBook($id)
    {
        $checkBorrowing = Rental::where([
            ['_id', '=', $id]
        ])->count();

        // if ($checkBorrowing == 1) {
        //     return response()->json([
        //         'status' => 'error',
        //         'messenger' => 'Trả sách thất bại'
        //     ], 422);
        // }

        $check = Rental::where([
            ['_id', '=', $id]
        ])->update(['return_date' => date('Y/m/d h:i:s', time())]);

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

    public function index(Request $request)
    {
        $rentals = Rental::with('user', 'book')->filter($request->all())->get();

        return $rentals;
    }
}