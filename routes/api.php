<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController; 
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BorrowingController;

Route::post('login', [AuthController::class, 'login']);
Route::post('register', [AuthController::class, 'register']);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::apiResource('books', BookController::class)->names([
        'index'   => 'api.books.index',
        'store'   => 'api.books.store',
        'show'    => 'api.books.show',
        'update'  => 'api.books.update',
        'destroy' => 'api.books.destroy',
    ]);

    Route::apiResource('borrowings', BorrowingController::class)->names([
        'index'   => 'api.borrowings.index',
        'store'   => 'api.borrowings.store',
        'show'    => 'api.borrowings.show',
        'update'  => 'api.borrowings.update',
        'destroy' => 'api.borrowings.destroy',
    ]);

    Route::apiResource('products', ProductController::class)->names('api.products');
});