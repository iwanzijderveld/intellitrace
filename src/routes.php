<?php 
Route::middleware('web')->namespace('Insanetlabs\IntelliTrace\Controllers')->prefix('intellitrace')->group(function () {

    // Authentication routes
    Route::get('/', 'Auth\LoginController@showLoginPage');
    Route::get('/login', 'Auth\LoginController@showLoginPage');
    Route::get('/logout', 'Auth\LoginController@logout');
    Route::get('/email', 'Auth\ForgotPasswordController@showLinkRequestForm');
    Route::post('/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
    Route::get('/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
    Route::post('/reset', 'Auth\ResetPasswordController@reset');
    Route::post('/login', 'Auth\LoginController@login');
    Route::get('/register', 'Auth\RegisterController@showRegistrationForm');
    Route::post('/register', 'Auth\RegisterController@register');



    // intellitrace app routes
    Route::get('/dashboard', 'IntelliTraceController@dashboard');
    Route::get('/overview', 'IntelliTraceController@overview');
});
?> 