<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::group(['prefix' => '/post'], function (){
    Route::get('/', [PostController::class, 'index'])->name('post.index');
    Route::get('/create', [PostController::class, 'create'])->name('post.create')->middleware('role:writer|admin');
    Route::post('/', [PostController::class, 'store'])->name('post.store')->middleware('role:writer|admin');
    Route::get('/{post}', [PostController::class, 'show'])->name('post.show')->middleware('role:admin');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('post.edit')->middleware('role:editor|admin');
    Route::patch('/{post}', [PostController::class, 'update'])->name('post.update')->middleware('role:editor|admin');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('post.destroy')->middleware('permission:publish post');
});