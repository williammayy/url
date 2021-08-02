<?php

use App\Http\Controllers\UrlControlador;
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

Route::get('/', [UrlControlador::class,'indexView'])->middleware('auth');
Route::post('/', [UrlControlador::class,'store'])->middleware('auth');
Route::get('/visualizar/{id}', [UrlControlador::class,'visualizarPg'])->middleware('auth');

Auth::routes();


