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

// Admin Capabilities...
Route::group(['middleware' => ['admin', 'prevent-back-history']], function(){

	// Admin Dashboard Routes...
	Route::get('admin/dashboard', function () {
	    return view('admin.dashboard');
	});

	// User Page Routes...
	Route::get('admin/user/{role}', 'UserController@index');

	// Boss Sampah Page Routes...
	Route::get('admin/boss-sampah/{taken}', 'BossSampahController@index');
	Route::get('admin/boss-sampah/harga/sampah', 'BossSampahController@hargasampah')->name('admin.hargasampah');
	Route::get('admin/boss-sampah/ubah-format-uang/sampah', 'BossSampahController@ubahformatuang');
	Route::post('admin/boss-sampah/update/sampah', 'BossSampahController@updatehargasampah')->name('admin.updatesampah');

	// Boss Green Store Page Routes...
	Route::get('admin/boss-green-store/semua-produk', 'ProdukController@index');
	Route::get('admin/boss-green-store/tambah-produk', 'ProdukController@create');
	Route::post('admin/boss-green-store/simpan-produk', 'ProdukController@store');
	Route::get('admin/boss-green-store/kategori', function(){
		return view('admin/kategori.index');
	});

	// Admin Logout Routes...
	Route::post('admin/logout', 'AdminLoginController@logout')->name('admin.logout');
});

// Kurir Capabilities...
Route::group(['middleware' => ['kurir', 'prevent-back-history']], function(){

	// Kurir Dashboard Routes...
	Route::get('kurir/dashboard', function () {
	    return view('kurir.dashboard');
	});

	// Boss Sampah Page Routes...
	Route::get('kurir/boss-sampah/{taken}', 'BossSampahController@indexkurir');
	Route::get('kurir/boss-sampah/jemput/{id}', 'BossSampahController@jemput');
	Route::get('kurir/boss-sampah/batal-jemput/{id}', 'BossSampahController@bataljemput');
	Route::get('kurir/boss-sampah/verifikasi/{id}', 'BossSampahController@verifikasi');
	Route::get('kurir/hitung-harga-sampah', 'BossSampahController@hitung');
	Route::post('kurir/verifikasi-sampah', 'BossSampahController@submitverifikasi')->name('kurir.verifikasi');

	// Kurir Logout Routes...
	Route::post('kurir/logout', 'KurirLoginController@logout')->name('kurir.logout');
});

// Guest Capabilities...
Route::group(['middleware' => ['guest', 'prevent-back-history']], function(){

	// Home Page
	Route::get('/', function () {
	    return view('welcome');
	});

	// Admin Authentication Routes...
	Route::get('admin/login', 'AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('admin/login', 'AdminLoginController@login');

	// Kurir Authentication Routes...
	Route::get('kurir/login', 'KurirLoginController@showLoginForm')->name('kurir.login');
	Route::post('kurir/login', 'KurirLoginController@login');

	// Kurir Registration Routes...
	Route::get('kurir/register', 'KurirRegisterController@showRegistrationForm')->name('kurir.register');
	Route::post('kurir/register', 'KurirRegisterController@register');

	// Member Password Reset Routes...
	Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
	Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
	Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
	Route::post('password/reset', 'Auth\ResetPasswordController@reset');
});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
