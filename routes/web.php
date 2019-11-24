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

//Route login,logout Admin

Route::get('edit-modal', 'UserController@getEditModal');

Route::get('admin/login', 'UserController@getLoginAdmin');
Route::post('admin/login', 'UserController@postLoginAdmin');
Route::get('admin/logout', 'UserController@getLogoutAdmin');

/*
 * Nhóm Route Admin
 * */
Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function () {

    Route::get('/', function () {
        return view('admin.layouts.index');
    });

    /*
     * Nhóm Route posts
     * */
    Route::group(['prefix' => 'posts'], function () {

        Route::get('/', 'PostController@index');
        Route::post('add', 'PostController@postAdd')->name('post.add');

        Route::post('delete', 'PostController@postDelete')->name('admin.posts.delete');

        Route::post('edit-modal', 'PostController@openEditModal')
            ->name('admin.posts.open_edit_modal');

        Route::post('edit', 'PostController@postEdit')->name('admin.posts.edit');

        Route::get('result', function () {
            return view('admin.posts.result');
        });
        Route::get('content_post', 'PostController@getContentPost');
    });

    /*
     *Nhóm route Users
     * */

    Route::group(['prefix' => 'users',], function () {

        Route::get('/', 'UserController@getAll');

        Route::post('add', 'UserController@postAdd')->name('user.add');

        Route::post('edit_modal_user', 'UserController@openEditModalUser')->name('admin.users.edit_modal_user');

        Route::post('edit', 'UserController@postEdit')->name('admin.users.edit');

        Route::post('delete', 'UserController@postDelete')->name('admin.users.delete');

        Route::post('ajax_index', 'UserController@indexAjax');
    });

    /*
     * Route comment
     * */

    Route::get('comments', 'CommentController@getComment');

    Route::post('comments/delete', 'CommentController@postDelete')->name('admin.comments.delete');

    /*
     * Group permissions
     * */
    Route::group(['prefix' => 'permissions'], function () {

        Route::get('/', 'PermissionController@getAll');

        Route::post('add', 'PermissionController@postAdd')->name('admin.permissions.add');

        Route::post('edit_modal_permission', 'PermissionController@openEditModalPermission')
            ->name('admin.permissions.edit_modal_permission');

        Route::post('edit', 'PermissionController@postEdit')->name('admin.permissions.edit');

        Route::post('delete', 'PermissionController@postDelete')->name('admin.permissions.delete');
    });

    /*
     * Group permissions
     * */

    Route::group(['prefix' => 'roles'], function () {

        Route::get('/', 'RoleController@getAll');

        Route::post('add', 'RoleController@postAdd')->name('admin.roles.add');

        Route::post('edit_modal_role', 'RoleController@openEditModalRole')
            ->name('admin.roles.edit_modal_role');

        Route::post('edit', 'RoleController@postEdit')->name('admin.roles.edit');

        Route::post('delete', 'RoleController@postDelete')->name('admin.roles.delete');
    });
});

/*
 * Route homepage
 * */

Route::get('/', 'Pages\PageController@homepage');

Route::get('login', 'Pages\PageController@getLogin');
Route::post('login', 'Pages\PageController@postLogin');

Route::get('logout', 'Pages\PageController@getLogout');

Route::get('register', 'Pages\PageController@getRegister');
Route::post('register', 'Pages\PageController@postRegister');

Route::get('forgot_password', 'Pages\PageController@getForgotPassword');
Route::post('forgot_password', 'Pages\PageController@postForgotPassword');

Route::get('user_personal/{id}', 'Pages\PageController@getUserPersonal');
Route::post('user_personal/{id}', 'Pages\PageController@postUserPersonal');

Route::get('detail/{id}/{title_link}.html', 'Pages\PageController@getDetail');

Route::post('add-comments', 'CommentController@postComment')->name('comments.add_comments');
