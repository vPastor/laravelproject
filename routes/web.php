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
Route::get('/', 'ProductController@all');
Route::get('/category/{id?}', 'ProductController@category');
Route::post('/rating', 'ProductController@rating');

Route::get('/compra', 'CompraController@main');
Route::get('/compra/resumen', 'CompraController@resumen');
Route::get('/compra/envio', 'CompraController@envio');
Route::post('/compra/envio', 'CompraController@verificarEnvio');
Route::get('/compra/confirmar', 'CompraController@confirmar');
Route::post('stock', 'CompraController@checkStock');
Route::post('compra', 'CompraController@compra');
