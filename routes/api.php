<?php

use App\Models;
use App\Models\Book;
use App\Models\Type;
use App\Models\User;
use App\Models\Country;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\CountryController;

use App\Http\Controllers\ManageUserController;
use App\Http\Controllers\TypeController;

// use App\Http\Controllers\BookController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::group([
        'middleware' => 'api',
        'prefix' => 'auth'

    ], function ($router) {
        Route::post('/login', [AuthController::class, 'login'])->name('login');
        Route::get('login', function () {
            return response()->json(
                ['error' => 'Unauthorized'],
                401
            );
        });

        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/update-role', [AuthController::class, 'updateRole']);
        Route::post('/refresh-token', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
    });

    //route book
    Route::prefix('book')->group(function () {
        Route::post('/{book}', [App\Http\Controllers\BookController::class, 'update']);
        Route::get('/top-borrowing', [App\Http\Controllers\BookController::class, 'topBorrowing']);
        Route::get('/get-latest-books', [App\Http\Controllers\BookController::class, 'getLatestBooks']);
        Route::get('/get-latest-books', [App\Http\Controllers\BookController::class, 'getLatestBooks']);
        Route::get('/get-latest-books', [App\Http\Controllers\BookController::class, 'getLatestBooks']);
    });
    Route::apiResource('book', BookController::class);



    //borrowing-book
    Route::prefix('borrowing-book')->group(function () {
        Route::get('check/{id}', [RentalController::class, 'checkBorrowing']);// sách đang được mượn hay k
        Route::get('/', [RentalController::class, 'index']); // danh sách mượn dành cho user
    });


    //admin
    Route::middleware(['auth', 'check-role'])->prefix('manage')->group(function () {
        Route::get('get-user', [ManageUserController::class, 'getUser']); // danh sách user
        Route::get('get-borrowing', [ManageUserController::class, 'getBorrowing']); // danh sách mượn
        Route::get('statistics-borrowing-book', [ManageUserController::class, 'statisticsBorrowingBook']);
        
        Route::prefix('rental-book')->group(function () {
            
            Route::post('/', [RentalController::class, 'store']);
            Route::delete('/{_id}', [RentalController::class, 'destroy']);
            Route::get('return-book/{_id}', [RentalController::class, 'returnBook']);
        });
    });

    Route::get('type', [TypeController::class, 'index']);

    Route::get('country', [CountryController::class, 'index']);

});