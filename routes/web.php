<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Spatie\Permission\Models\Role;

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
    return view('table');
})->name('login');

Route::post('/login', [UserController::class, 'store']);


Route::get('/forgot-password', function () {
    return view('login.forgot-password');
})->name('forgot-password');

Route::get('/index', function () {
    return view('index');
})->name('index');
