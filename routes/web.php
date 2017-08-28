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

Route::get('/','PagesController@home');

Route::get('/message/{message}','MessagesController@show');

Route::get('/home', 'HomeController@index');

Route::get('/user/{username}','UsersController@showMessages');


Auth::routes();

Route::group(['middleware'=>'auth'],function (){
    Route::post('messages/create','MessagesController@create');
    Route::post('/user/{username}/follow','UsersController@follow')->name('follow');
    Route::post('/user/{username}/unfollow','UsersController@unfollow')->name('unfollow');
    Route::post('/{username}/dms','UsersController@sendPrivateMessage')->name('sendPrivateMessage');
    Route::get('/conversation/{conversation}','UsersController@showMesssage')->name('showMessage');
    Route::get('/api/notifications','UsersController@notifications');
});

Route::get('/auth/facebook','SocialiteAuthController@facebook')->name('facebook');

Route::get('/auth/facebook/callback','SocialiteAuthController@callback');

Route::post('/auth/facebook/register','SocialiteAuthController@register')->name('register_facebook_account');

Route::get('/user/{username}/follows','UsersController@follows')->name('follows');

Route::get('/user/{username}/followers','UsersController@followers')->name('followers');

Route::get('/messages/search','MessagesController@search');

Route::get('/api/message/{message}','MessagesController@showJsonResponse');