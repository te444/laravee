<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::match(['get', 'post'], 'authors', 'AuthorsController@index');
Route::match(['get', 'post'], 'books', 'BooksController@index');
Route::match(['get', 'post'], 'categories', 'CategoriesController@index');


//Route::post('Authors_bilder', 'AuthorsController@bilderPost');
//Route::post('Books_bilder', 'BooksController@bilderPost');
//Route::post('Categories_bilder', 'CategoriesController@bilderPost');