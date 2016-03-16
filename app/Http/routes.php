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

Route::get('/', 'HomeController@index');

Route::get('/copasan', 'HomeController@copasan');
Route::get('/c/copasan', function (){return redirect(url('copasan'));});

Route::get('/copasanku', 'HomeController@copasanku');
Route::get('/c/copasanku', function (){return redirect(url('copasanku'));});

Route::get('/keluar', function (){return redirect(url('auth/logout'));});
Route::get('/c/keluar', function (){return redirect(url('keluar'));});

Route::get('/faq', 'HomeController@faq');
Route::get('/c/faq', function (){return redirect(url('faq'));});

Route::get('/kita', 'HomeController@kita');
Route::get('/c/kita', function (){return redirect(url('kita'));});

Route::get('/lapor/{hash}', 'HomeController@lapor');
Route::get('/c/lapor/{hash}', function ($hash){return redirect(url('lapor/'.$hash));});

Route::get('/embed/{hash}', 'HomeController@embed');
Route::get('/c/embed/{hash}', function ($hash){return redirect(url('embed/'.$hash));});

Route::get('/gabung', 'HomeController@gabung');
Route::get('/c/gabung', function (){return redirect(url('gabung'));});

Route::get('/masuk', 'HomeController@masuk');
Route::get('/c/masuk', function (){return redirect(url('masuk'));});

Route::post('/savecops', 'HomeController@save');

Route::get('/widget', 'HomeController@widget');

Route::get('/widgz', 'HomeController@widgz');
Route::post('/widgz', 'HomeController@widgzsave');

Route::get('/{hash}', 'HomeController@hash');
Route::get('/c/h/{hash}', function ($hash){return redirect(url($hash));});

Route::post('vauth/login',function ()
{
	$credentials = App\User::where('email',Input::get('email'))->first();
	if(!empty($credentials)){
		if($credentials->password==""){
			if(md5(Input::get('password'))==$credentials->old_password){
				$credentials->password = bcrypt(Input::get('password'));
				$credentials->old_password = "";
				$credentials->save();
				Auth::loginUsingId($credentials->id);
				return redirect(url());
			}else{
				return redirect(url('masuk'));
			}
		}else{
			if (Auth::attempt(['email' => Input::get("email"), 'password' => Input::get("password")]))
	        {
	            return redirect()->intended(url());
	        }else{
	        	return redirect(url('masuk'));
	        }
		}
	}else{
		return redirect(url('masuk'));
	}
});

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
