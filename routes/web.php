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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/post/{id}', 'AdminPostsController@post')->name('home.post');;
Route::get('/blog', 'HomeController@index')->name('blog');


Route::group(['middleware' => 'admin'], function(){
    
Route::resource('admin/users', 'AdminUsersController');
Route::resource('admin/posts', 'AdminPostsController');
Route::resource('admin/categories', 'AdminCategoriesController');
Route::resource('admin/medias', 'AdminMediasController');
Route::resource('admin/comments', 'CommentsController');
Route::resource('admin/replies', 'CommentRepliesController');

Route::get('/admin', function(){
    return view('admin.index');
});
Route::get('medias/manage', 'AdminMediasController@manage')->name('medias.manage');
Route::get('/file-manager', function(){
    return view('file-manager');
});
});

Route::group(['middleware' => 'auth'], function(){
Route::post('/comment/reply', 'CommentRepliesController@createReply');
});