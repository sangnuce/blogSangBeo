<?php

Route::group(['middleware' => ['web']], function () {
    Route::get('/', ['as' => 'home', 'uses' => 'WebController@index']);
    Route::get('search', ['as' => 'search', 'uses' => 'WebController@getSearch']);
    Route::get('post/{id}', ['as' => 'post', 'uses' => 'PostController@viewPost']);
    Route::get('cate/{id}', ['as' => 'cate', 'uses' => 'CateController@viewCate']);
    Route::get('user/{id}', ['as' => 'user', 'uses' => 'UserController@viewUserPost']);

    Route::group(['middleware' => 'guest'], function () {
        Route::get('register', ['as' => 'register', 'uses' => 'UserController@getRegister']);
        Route::post('register', ['as' => 'register', 'uses' => 'UserController@postRegister']);
        Route::get('login', ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
        Route::post('login', ['as' => 'login', 'uses' => 'Auth\AuthController@postLogin']);
    });

    Route::group(['middleware' => 'auth'], function () {
        Route::get('logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);
        Route::post('post/{post_id}/comment', ['as' => 'post.comment', 'uses' => 'CommentController@postComment']);
        Route::get('account', ['as' => 'account', 'uses' => 'UserController@getAccount']);
        Route::post('account', ['as' => 'account', 'uses' => 'UserController@postAccount']);
    });

    Route::group(['middleware' => 'admin'], function () {
        Route::group(['prefix' => 'admin'], function () {
            Route::get('/', ['as' => 'admin', 'uses' => 'WebController@admin_index']);
            Route::group(['prefix' => 'cate'], function () {
                Route::get('/', ['as' => 'admin.cate', 'uses' => 'CateController@getList']);
                Route::get('list', ['as' => 'admin.cate.list', 'uses' => 'CateController@getList']);
                Route::get('add', ['as' => 'admin.cate.add', 'uses' => 'CateController@getAdd']);
                Route::post('add', ['as' => 'admin.cate.add', 'uses' => 'CateController@postAdd']);
                Route::get('edit/{id}', ['as' => 'admin.cate.edit', 'uses' => 'CateController@getEdit']);
                Route::post('edit/{id}', ['as' => 'admin.cate.edit', 'uses' => 'CateController@postEdit']);
            });
            Route::group(['prefix' => 'user'], function () {
                Route::get('/', ['as' => 'admin.user', 'uses' => 'UserController@getList']);
                Route::get('list', ['as' => 'admin.user.list', 'uses' => 'UserController@getList']);
                Route::get('edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@getEdit']);
                Route::post('edit/{id}', ['as' => 'admin.user.edit', 'uses' => 'UserController@postEdit']);
            });
            Route::group(['prefix' => 'post'], function () {
                Route::get('/', ['as' => 'admin.post', 'uses' => 'PostController@getList']);
                Route::get('list', ['as' => 'admin.post.list', 'uses' => 'PostController@getList']);
                Route::get('add', ['as' => 'admin.post.add', 'uses' => 'PostController@getAdd']);
                Route::post('add', ['as' => 'admin.post.add', 'uses' => 'PostController@postAdd']);
                Route::get('edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostController@getEdit']);
                Route::post('edit/{id}', ['as' => 'admin.post.edit', 'uses' => 'PostController@postEdit']);
            });
            Route::group(['prefix' => 'comment'], function () {
                Route::get('/', ['as' => 'admin.comment', 'uses' => 'CommentController@getList']);
                Route::get('list', ['as' => 'admin.comment.list', 'uses' => 'CommentController@getList']);
            });
        });
        Route::group(['prefix' => 'ajax'], function () {
            Route::group(['prefix' => 'cate'], function () {
                Route::get('delete', ['as' => 'ajax.cate.delete', 'uses' => 'AjaxController@getDeleteCate']);
            });
            Route::group(['prefix' => 'user'], function () {
                Route::get('delete', ['as' => 'ajax.user.delete', 'uses' => 'AjaxController@getDeleteUser']);
            });
            Route::group(['prefix' => 'post'], function () {
                Route::get('delete', ['as' => 'ajax.post.delete', 'uses' => 'AjaxController@getDeletePost']);
                Route::get('remove-image', ['as' => 'ajax.post.removeImage', 'uses' => 'AjaxController@getPostRemoveImage']);
            });
            Route::group(['prefix' => 'comment'], function () {
                Route::get('delete', ['as' => 'ajax.comment.delete', 'uses' => 'AjaxController@getDeleteComment']);
                Route::get('approve', ['as' => 'ajax.comment.approve', 'uses' => 'AjaxController@getApproveComment']);
            });

        });
    });
});