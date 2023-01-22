<?php

use Illuminate\Support\Facades\Route;
Route::get('/product_list','ProductController@productList');
Route::delete('/delete_product/{product_id}','ProductController@deleteProduct');
Route::get('/product_api','ProductController@vendor_product_api')->name('all_product.list');
Route::get('/single-product-information/{id}','ProductController@single_product_information');

Route::get('/add_product','ProductController@addProduct');
Route::post('/add_product','ProductController@storeProduct');
Route::post('/product_update','ProductController@productUpdate')->name('product.update');

