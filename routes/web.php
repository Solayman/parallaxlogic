<?php

use Illuminate\Support\Facades\Route;

// load the view file
Route::get('/','DataController@homepage');

// super admin auth
Route::get('/login', [App\Http\Controllers\AdminAuthController::class, 'admin_login_page']);
Route::post('/login-status', [App\Http\Controllers\AdminAuthController::class, 'admin_login']);


Route::get('/admin/logout', [App\Http\Controllers\AdminAuthController::class, 'admin_logout'])
->middleware('super_admin');
Route::get('/admin/dashboard', [App\Http\Controllers\AdminAuthController::class, 'admin_dashboard']);


