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
   /* Cache Clear Start*/
		Route::get('/cache', function(){
			Artisan::call('cache:clear');
			Artisan::call('config:clear');
			Artisan::call('route:clear');
			Artisan::call('view:clear');
			 return redirect('/');
		});
	/* Cache Clear End*/  
	Route::get('/','Admin\LoginController@index'); 
	Route::post('login','Admin\LoginController@admin_login')->name('admin_login');
	Route::post('logout','Admin\LoginController@logout')->name('logout');
  
	/* Admin Route Start*/
	Route::group(['middleware' => 'auth', 'admin'], function(){
		
		Route::group(['namespace'=>'Admin'], function(){

			 Route::get('dashboard','HomeController@dashboard')->name('admin_dashboard');
			 
			  /* Free  Admin  Profile Start*/
			 Route::get('adminprofile','AdminController@index');
			 Route::get('adminpassword','AdminController@adminpassword');
			 Route::post('update','AdminController@update_admin')->name('update_admin');
			 Route::post('changepass','AdminController@changepass')->name('changepass');
			  /* Free  Admin  Profile End */
			 /* Free  Admin  subscription Start*/
			 Route::get('orders','HomeController@orders');
			 Route::get('orders/create','HomeController@orders_create');
			 Route::post('orders/store','HomeController@orders_store');
			 Route::get('remove_row','HomeController@remove_row')->name('remove_row');
			 Route::get('get_models','HomeController@get_models')->name('get_models');

			 Route::get('service','HomeController@service')->name('service');
			 Route::get('service/create','HomeController@service_create')->name('service_create');
			 Route::post('service/store','HomeController@service_store');
		});
	});
	
