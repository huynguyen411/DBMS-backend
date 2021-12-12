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
    public function __construct()
    {
        $this->middleware(['auth:api', 'check-role'], ['only' => ['getUser', 'destroy']]);
    }
    public function getUser(Request $request)
    {
        return User::filter($request->all())->get();
    }

    public function destroy($id)
    {
        $countUser = User::where('_id', $id)->count();
        if ($countUser == 0) {
            return response()->json([
                'status' => 'error',
                'messenger' => 'Tài khoản không tồn tại'
            ], 400);
        }

        User::where('_id', $id)->delete();
        return response()->json([
            'status' => 'ok',
            'messenger' => 'Xoá tài khoản thành công'
        ], 200);
    }
}