<?php

use App\Infrastructure\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('invoice/{n}', [InvoiceController::class, 'show']);
Route::get('invoice/{n}/approve', [InvoiceController::class, 'approve']);
Route::get('invoice/{n}/reject', [InvoiceController::class, 'reject']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
