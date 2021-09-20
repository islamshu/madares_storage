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



Route::group(['middleware' => ['auth'],'prefix' => 'dashbaord'], function() {
   
    Route::get('/logout','AdminController@logout' )->name('admin.logout');
  Route::prefix('admin')->group(function () {
    
  });
  Route::group(['middleware' => ['role:اداري']], function () {
    Route::resource('brancehs', BranchController::class);
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
});
    Route::resource('products', ProductController::class);
    Route::get('cart','CartController@cart')->name('cart');
    Route::post('add-to-cart','CartController@addToCart')->name('add.to.cart');
    Route::patch('update-cart','CartController@update')->name('update.cart');
    Route::patch('update-cart-note','CartController@update_note')->name('update_note');

    
    Route::delete('remove-from-cart','CartController@remove')->name('remove.from.cart');
    Route::post('updateNavCart','CartController@updateNavCart')->name('updateNavCart');
    Route::get('all_item','ProductController@all_item')->name('all_item');
    Route::post('makeOrder','OrderController@store')->name('makeOrder');
    Route::get('orders','OrderController@index')->name('orders.index');
    Route::get('order/{id}','OrderController@show')->name('orders.show');

    Route::post('confirm_order','OrderController@update_order_detle')->name('update-multiple-category');

    Route::get('updatetable/{id}','OrderController@updatetable')->name('updatetable');
    Route::post('update_delevry','OrderController@update_delevry')->name('update-delevery-status');

    Route::get('create_pdf/{id}','OrderController@generate_pdf')->name('generate_pdf');

   
    Route::get('/', function () {
        return view('admin.index');
    })->name('admin.dashboard');


});
Auth::routes();
Route::group(['prefix' => 'dashbaord'], function() {
    Route::get('/login','AdminController@get_login' )->name('get_login');
    Route::post('/login','AdminController@post_login' )->name('post_login');
    

});


Route::get('/', function () {
    return redirect()->route('admin.dashboard');
    });