<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\BorrowingBook;
use App\Models\User;
use App\Models\BorrowingStatus;
use DateTime;

class ManageUserController extends Controller
{
    public function getUser(Request $request)
    {
        return User::filter($request->all())->get();
    }

    public function getBorrowing(Request $request)
    {
        $list = BorrowingBook::filter($request->all())->get();


        foreach ($list as $key => $user) {
            $stt = BorrowingStatus::where('borrowing_status_id', $user->status_id)->get();
            $book = Book::where('book_id', $user->book_id)->get();
            $userinfo = User::where('id', $user->borrower_id)->get();
            $list[$key]->status = $stt;
            $list[$key]->book = $book;
            $list[$key]->user = $userinfo;
        }
        return response()->json([
            'borrowing' => $list,
        ]);
    }

    public function statisticsBorrowingBook()
    {
        $totalBorrowingBook = BorrowingBook::all()->count();
        $countBorrowingBook = BorrowingBook::where('status_id', 1)->count();
        $countReturnBook = BorrowingBook::where('status_id', 2)->count();

        return response()->json([
            'totalBorrowingBook' => $totalBorrowingBook,
            'countBorrowingBook' => $countBorrowingBook,
            'countReturnBook' => $countReturnBook,
        ]);
    }
}
