<?php

Route::group(['middleware' => ['web']], function () {

	// Home
	Route::get('/', [
		'uses' => 'HomeController@index', 
		'as' => 'home'
	]);
	Route::get('language/{lang}', 'HomeController@language')->where('lang', '[A-Za-z_-]+');


	// Admin
	Route::get('admin', [
		'uses' => 'AdminController@admin',
		'as' => 'admin',
		'middleware' => 'admin'
	]);
    Route::get('dashboard', 'DashboardController@index');
	

	// Blog
	

	// Contact
	Route::resource('contact', 'ContactController', [
		'except' => ['show', 'edit']
	]);


	// User
	Route::get('user/sort/{role}', 'UserController@indexSort');

	Route::get('user/roles', 'UserController@getRoles');
	Route::post('user/roles', 'UserController@postRoles');

	Route::put('userseen/{user}', 'UserController@updateSeen');

	Route::resource('user', 'UserController');
	
	Route::resource('plan', 'PlanController');

	// Authentication routes...
	Route::get('auth/login', 'Auth\AuthController@getLogin');
	Route::post('auth/login', 'Auth\AuthController@postLogin');
	Route::get('auth/logout', 'Auth\AuthController@getLogout');
	Route::get('auth/confirm/{token}', 'Auth\AuthController@getConfirm');

	// Resend routes...
	Route::get('auth/resend', 'Auth\AuthController@getResend');

	// Registration routes...
	Route::get('auth/register', 'Auth\AuthController@getRegister');
	Route::post('auth/register', 'Auth\AuthController@postRegister');

	// Password reset link request routes...
	Route::get('password/email', 'Auth\PasswordController@getEmail');
	Route::post('password/email', 'Auth\PasswordController@postEmail');

	// Password reset routes...
	Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
	Route::post('password/reset', 'Auth\PasswordController@postReset');
	
	


});

Route::get('/user_images/{size}/{name}', function($size = NULL, $name = NULL){
	
		if(!is_null($size) && !is_null($name)){
			$size = explode('x', $size);
			 $cache_image = Image::cache(function($image) use($size, $name){
			   return $image->make(url('/user_images/'.$name))->resize($size[0], $size[1]);
			}, 10); // cache for 10 minutes
			
			
		  return Response::make($cache_image, 200, ['Content-Type' => 'image']);
		} else {
			abort(404);
		}
});
Route::post('/{bottoken}/webhook', function () {
    $update = Telegram::commandsHandler(true);

    // Commands handler method returns an Update object.
    // So you can further process $update object 
    // to however you want.

    return 'ok';
});