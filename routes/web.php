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
    return view('pages-home');
});
Route::get('/error', function () {
    return view('pages-error');
});
Route::any('/act_Login', 'UserController@checkLogin');
// Route::post('/checkLogin', 'UserController@checkLogin');
// Route::get('/checkLogin', 'UserController@checkLogin');
Route::get('/act_Logout', 'UserController@checkLogout');
Route::any('/act_LoginPage', 'UserController@index');
Route::any('/sum', 'SumController@getListPatientByCompanyCode');
Route::any('/act_getSum', 'ajax@getSum');
Route::any('/act_updateKQCLS', 'ajax@updateKQCLS');
Route::any('/act_updateKQKLS', 'ajax@updateKQKLS');
Route::any('/act_updateSumResult', 'ajax@updateSumResult');

