<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\BlogController;

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
    return view('welcome');
});

Route::resource('news', NewsController::class)
    ->except(['store', 'update']);
Route::post('news/create', [NewsController::class, 'store'])
    ->name('news.store');
Route::put('news/{news}/edit', [NewsController::class, 'update'])
    ->name('news.update');

Route::resource('blogs', BlogController::class);
