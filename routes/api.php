<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/cart', 'CartController@store')->name('cart.store');
Route::delete('/cartItem/{cartItem}', 'CartController@deleteCartItem')->name('cart.cartItem.delete');
Route::post('/order', 'OrderController@store')->name('order.store');
Route::post('/profile/{userId}', 'UserController@store')->name('profile.store');
Route::post('/address/{userId}', 'AddressController@store')->name('address.store');
Route::put('/order/{orderNo}', 'AdminOrderController@store')->name('adminorder.store');
Route::post('/upload', 'AdminOrderController@saveService')->name('adminorder.upload');
Route::get('/categories', 'AdminOrderController@getCategories')->name('adminorder.categories');
Route::post('/admin_create', 'Home\EmployeeHomeController@create')->name('employee.create');



