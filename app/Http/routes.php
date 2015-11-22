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

Route::get('/', ['as' => 'home', 'uses' => 'PostsController@getPage']);


// AuthController
Route::get('register', ['as' => 'getRegister', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('register', ['as' => 'postRegister', 'uses' => 'Auth\AuthController@postRegister']);

Route::get('logout', ['as' => 'getLogout', 'uses' => 'Auth\AuthController@getLogout']);

Route::get('login', ['as' => 'getLogin', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('login', ['as' => 'postLogin', 'uses' => 'Auth\AuthController@postLogin']);


// PasswordController
Route::get('email', ['as' => 'getEmail', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('email', ['as' => 'postEmail', 'uses' =>'Auth\PasswordController@postEmail']);

Route::get('reset/{token}', ['as' => 'getReset', 'uses' => 'Auth\PasswordController@getReset']);
Route::post('reset', ['as' => 'postReset', 'uses' =>'Auth\PasswordController@postReset']);

// PostsController

Route::get('post', ['as' => 'getPostPage', 'uses' => 'PostsController@getPage']);
Route::get('post/show/{id}', ['as' => 'getPostShow', 'uses' => 'PostsController@getShow']);
Route::get('post/user/{id}', ['as' => 'getUserPost', 'uses' => 'PostsController@getUserPost']);
Route::get('post/category/{id}', ['as' => 'getCategoryPost', 'uses' => 'PostsController@getCategoryPost']);
Route::get('post/tag/{id}', ['as' => 'getTagPost', 'uses' => 'PostsController@getTagPost']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('post/create', ['as' => 'getPostCreate', 'uses' => 'PostsController@getCreate']);
	Route::post('post/create', ['as' => 'postPostCreate', 'uses' =>'PostsController@postCreate']);

	Route::get('post/mine', ['as' => 'getPostMine', 'uses' => 'PostsController@getMine']);
	Route::get('post/update/{id}', ['as' => 'getPostUpdate', 'uses' => 'PostsController@getUpdate']);
	Route::post('post/update', ['as' => 'postPostUpdate', 'uses' => 'PostsController@postUpdate']);

	Route::get('post/delete/{id}', ['as' => 'getPostDelete', 'uses' => 'PostsController@getDelete']);


	Route::post('post/upload',['as' => 'uploadPostImage','uses' => 'PostsController@uploadPostImage']);
	Route::post('post/comment',['as' => 'postPostComment','uses' => 'PostsController@postComment']);

});

// CategoriesController

Route::get('category',['as' => 'category','uses' => 'CategoriesController@getAllCategory']);

Route::group(['middleware' => 'auth'], function () {
	Route::get('category/create', ['as' => 'getCategoryCreate', 'uses' => 'CategoriesController@getCreate']);
	Route::post('category/create', ['as' => 'postCategoryCreate', 'uses' =>'CategoriesController@postCreate']);

});

// TagsController
Route::get('tag',['as' => 'tag','uses' => 'TagsController@getAllTag']);


// UsersController
Route::get('user',['as' => 'user','uses' => 'UsersController@getAllUser']);



