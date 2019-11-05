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

Route::get('everywhere',function(){
    return view('admin.posts.page');
});

//Route đăng nhập
Route::get('admin/login','Pages\userController@getLoginAdmin');
Route::post('admin/login','Pages\userController@postLoginAdmin');
Route::get('admin/logout','Pages\userController@getLogoutAdmin');

/*
 * Nhóm Admin
 * */
Route::group(['prefix'=>'admin','middleware'=>'adminLogin'],function(){

    Route::get('/',function(){
        return view('admin.layouts.index');
    });

    Route::group(['prefix'=>'posts'],function(){

        Route::get('/','Pages\postController@getAll');

        Route::post('add','Pages\postController@postAdd')->name('post.add');

        Route::post('edit-modal','Pages\postController@openEditModal')->name('admin.posts.open_edit_modal');
        Route::post('edit','Pages\postController@postEdit')->name('admin.posts.edit');

        Route::post('delete','Pages\postController@postDelete')->name('admin.posts.delete');

        Route::get('result',function (){
            return view('admin.posts.result');
        });
        Route::get('content_post','Pages\postController@getContentPost');

    });

    Route::group(['prefix'=>'users'],function(){

        Route::get('/','Pages\userController@getAll');

        Route::get('add','Pages\userController@getAdd');
        Route::post('add','Pages\userController@postAdd')->name('user.add');

        Route::get('edit/{id}','Pages\userController@getEdit');
        Route::post('edit/{id}','Pages\userController@postEdit');

        Route::get('delete/{id}','Pages\userController@getDelete');

        Route::post('ajax_index','Pages\userController@indexAjax');

    });

    Route::get('comment','Pages\commentController@getComment');
    Route::get('comment/delete/{id}','Pages\commentController@getDelete');

});

/*
 * Route homepage
 * */

Route::get('homepage','Pages\pageController@homepage');

Route::get('login','Pages\pageController@getLogin');
Route::post('login','Pages\pageController@postLogin');

Route::get('logout','Pages\pageController@getLogout');

Route::get('register','Pages\pageController@getRegister');
Route::post('register','Pages\pageController@postRegister');

Route::get('user_personal/{id}','Pages\pageController@getUserPersonal');
Route::post('user_personal/{id}','Pages\pageController@postUserPersonal');

Route::get('detail/{id}/{title_link}.html','Pages\pageController@getDetail');

Route::post('comments/{id}','Pages\commentController@postComment');
