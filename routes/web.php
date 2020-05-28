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
});

Route::get('/exam', 'ExamController@start')->name('exam.start');
Route::get('/practice', 'PracticeController@start')->name('practice.start');

Route::get('/ajaxGetQuestion/{id}', 'ExamController@getQuestion');
