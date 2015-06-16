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

Route::get('authors', 'AuthorsController@index');
Route::post('authors', 'AuthorsController@getBooks');

Route::get('books', 'BooksController@index');
Route::post('books', 'BooksController@getAuthorsCategories');

Route::get('categories', 'CategoriesController@index');
Route::post('categories', 'CategoriesController@getBooks');
