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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/','App\Http\Controllers\homecontroller@index');
Route::get('/produk','App\Http\Controllers\produkcontroller@index');
Route::get('/show', 'App\Http\Controllers\produkcontroller@show')->name('produk.show');
Route::get('/filter','App\Http\Controllers\produkcontroller@filter');
Route::get('/upload', 'App\Http\Controllers\produkcontroller@upload');
Route::post('/upload/proses', 'App\Http\Controllers\produkcontroller@proses_upload');
