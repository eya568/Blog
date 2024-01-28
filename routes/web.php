<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\LikeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('feed');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FeedController::class, 'index']);

Route::get('/publications/create', [PublicationController::class, 'create']);
Route::post('/publications',[PublicationController::class, 'store']);
Route::delete('/publications/{publication}',[PublicationController::class, 'destroy']);

Route::get('/publications/{publication}/edit',[PublicationController::class, 'edit']);
Route::patch('/publications/{publication}',[PublicationController::class, 'update']);
Route::post('/publications/{publication}/comments',[CommentController::class, 'store']);


Route::post('/publications/{publication}/reports',[ReportController::class, 'store']);
Route::post('/publications/{publication}/likes',[LikeController::class, 'store']);
