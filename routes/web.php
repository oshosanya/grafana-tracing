<?php

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

Route::get('/', function () {
    return view('welcome');
})->name('root_route');

Route::get('/hello', function () {
    return 'Hello';
})->name('hello_route');

Route::get('/register', function () {
    return view('customer_reg');
})->name('customer_reg_page');

Route::post('/register', [\App\Http\Controllers\PageController::class, 'register'])->name('submit_customer_reg');
