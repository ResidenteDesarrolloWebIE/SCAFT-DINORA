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

/* Rutas para iniciar sesion */
Route::get('/', 'Auth\LoginController@showLoginForm');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
/*Rutas para registrar usuario */
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');
/*Rutas para recperar contraseña*/
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');



/* Rutas para la pagina principal*/
Route::group(['middleware' => 'auth'], function () { 

    Route::get('/home', 'HomeController@index')->name('home');

    /* Accediendo a los metodos para manipular los servicios */
    Route::get('services', 'Quotes\ServiceController@showServices');
    Route::get('services/moreInformation','Quotes\ServiceController@showMoreInformation');
    Route::get('services/financialAdvance','Quotes\ServiceController@showFinancialAdvance');
    Route::get('services/technicalAdvance','Quotes\ServiceController@showTechnicalAdvance');
    Route::get('services/imagesGallery', 'ImageController@showImagesGallery');


    /* Accediendo a los metodos para manipular los suministos */
    Route::get('supplies', 'Quotes\ProductController@showProducts');
    Route::get('supplies/moreInformation','Quotes\ProductController@showMoreInformation');
    Route::get('supplies/financialAdvance','Quotes\ProductController@showFinancialAdvance');
    Route::get('supplies/technicalAdvance','Quotes\ProductController@showTechnicalAdvance');
    Route::get('supplies/imagesGallery', 'ImageController@showImagesGallery');

    Route::get('sincronizacion', 'Synchronization\AdmDatabaseSyncController@synchronizationWithAgate');
});


/*  Accediendo a los metdos para manipular imagenes */
Route::group(['middleware' => ['auth','admin']], function () { 
    Route::get('projects', 'ProjectsController@index');
    Route::post('upload', 'ImageController@postUpload')->name('upload-post');
    Route::post('upload/delete', 'ImageController@deleteUpload')->name('upload-remove');
    Route::get('server-images', 'ImageController@getServerImages')->name('server-images');
    Route::post('project/changeStatus', 'ProjectsController@changeStatus')->name('project-changeStatus');
});