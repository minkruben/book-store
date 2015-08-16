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

Route::get('/', 'MainController@index');
Route::get('search/{query}', ['as' => 'search', 'uses' => 'MainController@search']);
Route::get('category/{id}', ['as' => 'category', 'uses' => 'MainController@category']);
Route::get('author/{id}', ['as' => 'author', 'uses' => 'MainController@author']);
Route::get('book/{id}', ['as' => 'book', 'uses' => 'MainController@book']);
Route::get('cart', ['as' => 'cart', 'uses' => 'MainController@cart']);
Route::post('cart/{id}', ['as' => 'cart.add', 'uses' => 'MainController@add']);

Route::group(['namespace' => 'Auth'], function () {
	Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
	Route::post('login', 'AuthController@postLogin');
	Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@getLogout']);
	Route::get('register', ['as' => 'register', 'uses' => 'AuthController@getRegister']);
	Route::post('register', 'AuthController@postRegister');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth'], function () {
	Route::get('/',  ['as' => 'admin.index', 'uses' => 'DashboardController@index']);
	Route::resource('categories', 'CategoriesController', ['except' => ['show', 'destroy']]);
	Route::get('categories/search/{query}', ['as' => 'admin.categories.search', 'uses' => 'CategoriesController@search']);
	Route::delete('categories', ['as' => 'admin.categories.destroy', 'uses' => 'CategoriesController@destroy']);
	Route::resource('authors', 'AuthorsController', ['except' => ['show', 'destroy']]);
	Route::get('authors/search/{query}', ['as' => 'admin.authors.search', 'uses' => 'AuthorsController@search']);
	Route::delete('authors', ['as' => 'admin.authors.destroy', 'uses' => 'AuthorsController@destroy']);
	Route::resource('books', 'BooksController', ['except' => ['show', 'destroy']]);
	Route::get('books/search/{query}', ['as' => 'admin.books.search', 'uses' => 'BooksController@search']);
	Route::delete('books', ['as' => 'admin.books.destroy', 'uses' => 'BooksController@destroy']);
	Route::resource('users', 'UsersController', ['except' => ['show', 'destroy']]);
	Route::get('users/search/{query}', ['as' => 'admin.users.search', 'uses' => 'UsersController@search']);
	Route::delete('users', ['as' => 'admin.users.destroy', 'uses' => 'UsersController@destroy']);
});
