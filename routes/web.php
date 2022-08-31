<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\leeleecontroller; 
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
    return view('index');
})->middleware('leeleeauth');

Route::get('/login', function () {
    return view('login');
});

Route::POST('/login', [leeleecontroller::class, 'login']);  

// 로그아웃
Route::get('/logout', [leeleecontroller::class, 'logout']);
// Route::get('/regist', function () {
//     return view('regist');
// });

//페이지 이동
Route::get('/pages/{page}', [leeleecontroller::class, 'page'])->middleware('leeleeauth');




Route::POST('/aa', [leeleecontroller::class, 'test']);  