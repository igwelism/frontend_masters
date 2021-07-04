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

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('concierge.index');
});

//Route::get('/postcheckout', function () {
//    return view('concierge.postcheckout');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('food', 'FoodController');
Route::resource('laundry', 'LaundryController');
Route::resource('cleaning', 'CleaningController');
Route::get('/cart', 'CartController@index')->name('cart.index')->middleware('auth');
Route::get('send-mail', 'MailController@sendMail')->name('send.mail');
Route::get('/postcheckout/{orderNumber}', 'OrderController@postcheckout')->name('order.postcheckout');
Route::get('/profile', 'UserController@index')->name('profile.index');
Route::get('/address', 'AddressController@index')->name('address.index');
Route::get('/subscription', 'OrderController@index')->name('order.index')->middleware('auth');;
