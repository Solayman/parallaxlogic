<?php
use Illuminate\Support\Facades\Route;
// Role section

Route::group(['middleware' => ['super_admin']], function () {

// staff
Route::get('/staff', 'StaffController@show_staff')->name('show.staff');
Route::get('/sub/staff', 'StaffController@show_sub_staff')->name('show.sub.staff');
Route::get('/staff/datatables', 'StaffController@get_all_staff')->name('all_staff.list');
Route::get('/sub/staff/list', 'StaffController@sub_all_staff')->name('sub.staff.list');
Route::delete('/delete_staff_api/{id}', 'StaffController@delete_staff_api');
Route::get('/single-staff-information/{id}', 'StaffController@single_staff_info');
Route::post('update-staff', 'StaffController@update_staff');
Route::post('store-staff', 'StaffController@store_staff');
Route::get('/change_staff_password/{id}', 'StaffController@change_staff_password')->name('change_staff.password');
Route::post('/update-staff-password', 'StaffController@update_staff_password');

// profile
Route::get('/view_profile', 'AdminProfileController@view_profile')->name('admin.view.profile');
Route::post('/update_profile', 'AdminProfileController@update_profile')->name('admin.update.profile');
Route::post('/change-password', 'AdminProfileController@change_password')->name('admin.change.password');
});
