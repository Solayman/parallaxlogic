<?php

use Illuminate\Support\Facades\Route;
Route::group(['middleware' => ['super_admin']], function () {
// profile
Route::get('/view_profile', 'AdminProfileController@view_profile')->name('admin.view.profile');
Route::post('/update_profile', 'AdminProfileController@update_profile')->name('admin.update.profile');
Route::post('/change-password', 'AdminProfileController@change_password')->name('admin.change.password');
});
