<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PublicationController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Mail\resetLink;

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
Auth::routes();
Route::get('/', function () {
    return view('feed');
});
Route::get('/password/email', function () {
    return new resetLink();
});



Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/', [App\Http\Controllers\FeedController::class, 'index']);

//publication
Route::get('/publications/create', [PublicationController::class, 'create']);
Route::post('/publications',[PublicationController::class, 'store']);
Route::delete('/publications/{publication}',[PublicationController::class, 'destroy']);
Route::get('/publications/{publication}/edit',[PublicationController::class, 'edit']);
Route::patch('/publications/{publication}',[PublicationController::class, 'update']);
Route::post('/publications/{publication}/comments',[CommentController::class, 'store']);
Route::post('/publications/{publication}/reports',[ReportController::class, 'store']);
Route::post('/publications/{publication}/likes',[LikeController::class, 'store']);

//admin
Route::get('/adminHome',[HomeController::class,'index'])->name('adminHome')->middleware('role');
Route::get('/admin/users',[HomeController::class,'usersList'])->name('admin.users');
Route::get('/admin/reports',[HomeController::class,'reportsList'])->name('admin.reports');
Route::delete('/users/{user}',[AdminController::class, 'deleteUser']);
Route::delete('/publications/{publication}',[AdminController::class, 'deletePub']);
Route::post('/admin/users/{user}/changeRoles',[AdminController::class, 'ChangeRoles'])->name('admin.changeRoles');
Route::get('/admin/chartData',[AdminController::class,'chartData'])->name('admin.chartData');
