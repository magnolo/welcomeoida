<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


Route::group(['middleware' => ['api'], 'prefix' => 'api'], function(){

  Route::get('pois/all', 'PoiController@all');
  Route::get('pois/humans', 'PoiController@humans');
  Route::post('pois/humans', 'PoiController@createHuman');
  Route::get('pois/{id}', 'PoiController@byId');
  Route::get('pois/raw/{type}', 'PoiController@raw');

  Route::group(['middleware' => 'auth:all'], function(){
    Route::post('images', 'ImageController@upload');
    Route::post('pois/events', 'PoiController@createEvent');
  });
  Route::group(['prefix' => 'admin', 'middleware' => 'auth:administrator'], function(){
    Route::get('pois', 'Admin\AdminController@all');
    Route::get('users', 'Admin\AdminController@users');
    Route::put('users/{id}/role', 'Admin\AdminController@usersRole');
    Route::get('roles', 'Admin\AdminController@roles');
    Route::put('pois/public', 'Admin\AdminController@bulkPublic');
    Route::put('pois/{id}', 'Admin\AdminController@update');
    Route::patch('pois', 'Admin\AdminController@bulkDelete');

  });
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', ['as' => 'pages.home', 'uses' => 'PagesController@getHome' ]);

    $a = 'auth.';
    Route::get('/login',            ['as' => $a . 'login',          'uses' => 'Auth\AuthController@getLogin']);
    Route::post('/login',           ['as' => $a . 'login-post',     'uses' => 'Auth\AuthController@postLogin']);
    Route::get('/register',         ['as' => $a . 'register',       'uses' => 'Auth\AuthController@getRegister']);
    Route::post('/register',        ['as' => $a . 'register-post',  'uses' => 'Auth\AuthController@postRegister']);
    Route::get('/password',         ['as' => $a . 'password',       'uses' => 'Auth\PasswordResetController@getPasswordReset']);
    Route::post('/password',        ['as' => $a . 'password-post',  'uses' => 'Auth\PasswordResetController@postPasswordReset']);
    Route::get('/password/{token}', ['as' => $a . 'reset',          'uses' => 'Auth\PasswordResetController@getPasswordResetForm']);
    Route::post('/password/{token}',['as' => $a . 'reset-post',     'uses' => 'Auth\PasswordResetController@postPasswordResetForm']);


    Route::get('/social/redirect/{provider}', ['as' => 'social.redirect', 'uses' => 'Auth\AuthController@getSocialRedirect']);
    Route::get('/social/handle/{provider}', ['as' => 'social.handle', 'uses'=> 'Auth\AuthController@getSocialHandle']);

    Route::group(['middleware' => 'auth:all'], function(){
        Route::get('/logout', ['as' => 'authenticated.logout', 'uses' => 'Auth\AuthController@getLogout']);
        Route::get('/events', ['as' => 'user.events', 'uses' => 'EventController@userEvents']);
        Route::get('/events/{id}', ['as' => 'user.event', 'uses' => 'EventController@showEvent']);
        Route::put('/events/{id}', ['as' => 'user.event-update', 'uses' => 'EventController@updateEvent']);
    });

    Route::group(['middleware' => 'auth:administrator'], function(){
      Route::get('/admin', ['as' => 'admin.home', 'uses' => 'Admin\AdminController@home']);
    });

    Route::get('/{page}',['as' => 'page', 'uses' => 'PageController@show']);
});
