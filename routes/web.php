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

/**
 * Home
 */

Route::get('/home', [
	'uses' => '\weloveso\Http\Controllers\HomeController@homePage',
	'as'   => 'home',
]);
Route::get('/trending', [
	'uses' => '\weloveso\Http\Controllers\HomeController@trending',
	'as'   => 'trending',
]);
Route::get('/homeAll', [
	'uses' => '\weloveso\Http\Controllers\HomeController@homePageAll',
	'as'   => 'homeAll',
]);

Route::get('/', [
	'uses' => '\weloveso\Http\Controllers\WelcomeController@index',
	'as'   => 'welcome',
]);

/**
 * Authentication
 */

Route::get('/signup', [
	'uses' => '\weloveso\Http\Controllers\AuthController@getSignup',
	'as'   => 'auth.signup',
	// 'middleware'	=> ['guest'],
]);

Route::post('/signup', [
	'uses' => '\weloveso\Http\Controllers\AuthController@postSignup',
	// 'middleware'	=> ['guest'],
]);

Route::get('/signin', [
	'uses' => '\weloveso\Http\Controllers\AuthController@getSignin',
	'as'   => 'auth.signin',
	// 'middleware'	=> ['guest'],
]);

Route::post('/signin', [
	'uses' => '\weloveso\Http\Controllers\AuthController@postSignin',
	// 'middleware'	=> ['guest'],
]);

Route::get('/signout', [
	'uses' => '\weloveso\Http\Controllers\AuthController@getSignout',
	'as'   => 'auth.signout',
]);

Route::get('/authResults', [
	'uses' => '\weloveso\Http\Controllers\AuthController@getAuthResults',
	'as'   => 'auth.results',
	// 'middleware'	=> ['guest'],
]);

/**
 *	Search
 */

Route::get('/search', [
	'uses' => '\weloveso\Http\Controllers\SearchController@getResults',
	'as'   => 'search.results',
]);

/**
 * User Profile
 */

Route::get('/{username}' ,[
	'uses' => '\weloveso\Http\Controllers\ProfileController@getProfile',
	'as'   => 'profile.index',
]);


Route::post('/profile/intro',[
	'uses' => '\weloveso\Http\Controllers\ProfileController@postIntro',
	'as'   => 'profile.intro',
	'middleware' => ['auth'],
]);
Route::get('/profile/edit',[
	'uses' => '\weloveso\Http\Controllers\ProfileController@getEdit',
	'as'   => 'profile.edit',
	'middleware' => ['auth'],
]);


Route::post('/profile/edit',[
	'uses' => '\weloveso\Http\Controllers\ProfileController@postEdit',
	'middleware' => ['auth'],
]);

/**
 * Friends
 */

Route::get('/{username}/friends',[
	'uses' => '\weloveso\Http\Controllers\FriendController@getIndex',
	'as'   => 'friend.index',
	'middleware' => ['auth'],
]);

Route::get('/friends/add/{username}',[
	'uses' => '\weloveso\Http\Controllers\FriendController@getAdd',
	'as'   => 'friend.add',
	'middleware' => ['auth'],
]);


Route::get('/friends/accept/{username}',[
	'uses' => '\weloveso\Http\Controllers\FriendController@getAccept',
	'as'   => 'friend.accept',
	'middleware' => ['auth'],
]);

/**
 * Statuses
 */

Route::post('/status',[
	'uses' => '\weloveso\Http\Controllers\StatusController@postStatus',
	'as'   => 'status.post',
	'middleware' => ['auth'],
]);

Route::post('/status/{statusId}/reply',[
	'uses' => '\weloveso\Http\Controllers\StatusController@postReply',
	'as'   => 'status.reply',
	'middleware' => ['auth'],
]);

Route::get('/status/{statusId}/like',[
	'uses' => '\weloveso\Http\Controllers\StatusController@getLike',
	'as'   => 'status.like',
	'middleware' => ['auth'],
]);
/**
 * Look At
 */

Route::get('/{username}/location/store',[
	'uses' => '\weloveso\Http\Controllers\companyLocationsController@storeLocations',
	'as'   => 'company.locations',
	'middleware' => ['auth'],
]);
