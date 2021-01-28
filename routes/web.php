<?php

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
});

Route::get('/getUsers', 'staffController@getAllUsers');
Route::get('/getStaff', 'staffController@getAllStaff');
Route::get('/getAllStudentsByBatch/{batch}', 'staffController@getAllStudentsByBatch');
Route::get('/autoGenerate/{batch}/{center}', 'staffController@autoGenerateTask');
Route::get('/getTasks/{center}', 'staffController@getTasks');
Route::get('/trial/{batch}', 'staffController@trial');


