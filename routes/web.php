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


use Illuminate\Support\Facades\Auth;


Route::middleware(['auth'])->group(function(){

    Route::get('/', 'PagesController@index')->name('home');


    Route::resource('user', 'UserController');
    Route::resource('category', 'CategoryController');
    Route::resource('category-image', 'CategoryImageController');
    Route::resource('food', 'FoodController');
    Route::resource('food-image', 'FoodImageController');
    Route::resource('addon', 'AddOnController');
    Route::resource('addon-image', 'AddOnImageController');
    Route::resource('addonassign', 'AddonsFoodController');

});

Auth::routes([
    'register' => false, // Registration Routes...
    'reset' => false, // Password Reset Routes...
    'verify' => false, // Email Verification Routes...
]);


Route::get('/logout',function(){
    Auth::logout();
    return redirect()->route('home');
});
