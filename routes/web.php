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




Route::resource('/contact', 'ContactsController');

/**
 * * Return an array of all contacts
 */
Route::get('allContacts', 'ContactsController@allContacts');


Route::get('/', function () {
    return view('index');
});
