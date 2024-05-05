<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'ClientController@home');
Route::get('/shop', 'ClientController@shop');
Route::get('/cart', 'ClientController@cart');
Route::get('/checkout', 'ClientController@checkout');
Route::get('/client_login', 'ClientController@client_login');
Route::get('/client_signup', 'ClientController@client_signup');
Route::get('/add_to_cart/{id}', 'ClientController@add_to_cart');
Route::post('/updateqty', 'ClientController@updateqty');
Route::get('/removeitem/{id}', 'ClientController@removeitem');
Route::post('/postcheckout', 'ClientController@postcheckout');
Route::post('/createaccount', 'ClientController@createaccount');
Route::post('/accessaccount', 'ClientController@accessaccount');
Route::get('/client_logout', 'ClientController@client_logout');
Route::get('/view_by_cat/{name}', 'ClientController@view_by_cat');

Route::get('/admin', 'AdminController@dashboard');
Route::get('/orders', 'AdminController@orders');

Route::get('/addcategory', 'CategoryController@addcategory');
Route::post('/savecategory', 'CategoryController@savecategory');
Route::get('/categories', 'CategoryController@categories');
Route::get('/editcategory/{id}', 'CategoryController@editcategory');
Route::post('/updatecategory', 'CategoryController@updatecategory');
Route::get('/deletecategory/{id}', 'CategoryController@deletecategory');

Route::get('/products', 'ProductController@products');
Route::get('/addproduct', 'ProductController@addproduct');
Route::post('/saveproduct', 'ProductController@saveproduct');
Route::get('/editproduct/{id}', 'ProductController@editproduct');
Route::post('/updateproduct', 'ProductController@updateproduct');
Route::get('/deleteproduct/{id}', 'ProductController@deleteproduct');
Route::get('/activeproduct/{id}', 'ProductController@activeproduct');
Route::get('/unactiveproduct/{id}', 'ProductController@unactiveproduct');

Route::get('/sliders', 'SliderController@sliders');
Route::get('/addslider', 'SliderController@addslider');
Route::post('/saveslider', 'SliderController@saveslider');
Route::get('/editslider/{id}', 'SliderController@editslider');
Route::post('/updateslider', 'SliderController@updateslider');
Route::get('/deleteslider/{id}', 'SliderController@deleteslider');
Route::get('/activeslider/{id}', 'SliderController@activeslider');
Route::get('/unactiveslider/{id}', 'SliderController@unactiveslider');

Route::get('/view_pdf/{name}', 'PdfController@view_pdf');

Auth::routes();

Route::get('/home', 'HomeController@index');
