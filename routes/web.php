<?php

Auth::routes();

Route::get('registro', function () {
  return view('templates/register');
})->name('registro');
// Route::post('register', 'RegistroController@store');
Route::get('rastreo', 'DocumentController@rastreo')->name('rastreo');
Route::get('rastrear/{number}', 'DocumentController@rastrear');
Route::get('home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
  Route::get('/', 'DocumentController@index');

  Route::delete('user/{id}', 'UserController@destroy');
  Route::put('users/{id}', 'UserController@update');
  Route::post('users', 'UserController@store');
  Route::get('users', 'UserController@index')->name('user');
  Route::get('user/validateEmail/{email}', 'UserController@validateEmail');
  Route::get('users/all', 'UserController@all');

  // Rutas del módulo tipo de guia
  Route::get('tipo_guia/all', 'TypeGuideController@all');
  Route::resource('tipo_guia', 'TypeGuideController')->except([
    'create', 'edit', 'show'
  ]);

  // Rutas del módulo documento
  Route::get('validarestado/{guia}/{estado}', 'DocumentController@validarestado');
  Route::delete('estado/{guia}/{estado}', 'DocumentController@destroy_estado');
  Route::post('crearEstado', 'DocumentController@crearEstado');
  Route::put('updateEstado', 'DocumentController@updateEstado');
  Route::get('documento/all', 'DocumentController@all');
  Route::resource('documento', 'DocumentController')->except([
    'create', 'edit', 'show'
  ]);

  // Rutas del módulo estado
  Route::get('estado/allSelect', 'StateController@allSelect');
  Route::get('estado/all', 'StateController@all');
  Route::resource('estado', 'StateController')->except([
    'create', 'edit', 'show'
  ]);
});


Route::namespace('People')->group(function () {
  Route::group(['prefix' => 'people'], function () {
    Route::group(['middleware' => 'auth'], function () {
      Route::get('index', 'PeopleController@index')->name('peoples');
      Route::get('all', 'PeopleController@all');
      Route::delete('{id}', 'PeopleController@delete');
      Route::post('update/{id}', 'PeopleController@update');
    });
    Route::post('save', 'PeopleController@store');
  });
});

Route::namespace('TrackingReceipt')->group(function () {
  Route::group(['prefix' => 'tracking_receipt'], function () {
    Route::group(['middleware' => 'auth'], function () {
      Route::get('index', 'TrackingReceiptController@index')->name('tracking_receipt');
      Route::get('all', 'TrackingReceiptController@all');
      Route::post('save', 'TrackingReceiptController@store');
      Route::delete('{id}', 'TrackingReceiptController@delete');
    });
  });
});

Route::group(['prefix' => 'global'], function () {
  Route::group(['middleware' => 'auth'], function () {
  });

  Route::get('validateEmailUnique/{email}', 'UserController@validateEmail');
});
