<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginRegisterController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::controller(LoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/logout', 'logout')->name('logout');
});

Route::namespace('App\Http\Controllers')->middleware('auth')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('category', 'CategoryController@index')->name('category');
    Route::get('customer', 'CustomerController@index')->name('customer_list');
    Route::get('customer-add', 'CustomerController@add')->name('customer_add');
    Route::post('customer-add', 'CustomerController@store')->name('store_customer');
    Route::get('customer-edit/{id}', 'CustomerController@edit')->name('customer_edit');
    Route::post('customer-edit', 'CustomerController@update')->name('customer_update');
    Route::get('add-materials', 'CustomerController@addMaterials')->name('add_materials');
    Route::post('add-materials', 'CustomerController@storeMaterials')->name('store_materials');
    Route::get('expance-materials/{userid}', 'CustomerController@expanceMaterials')->name('expance_materials');
    Route::post('expance-materials', 'CustomerController@storeExpanceMaterials')->name('store_expance_materials');
    Route::get('customer-transaction/{userid}', 'CustomerController@customerTransaction')->name('customer_transaction');
    Route::get('hapta', 'CustomerController@hapta')->name('hapta');
    Route::get('hapta-generate', 'CustomerController@haptaGenerate')->name('hapta_generate');
    Route::post('hapta_date_store', 'CustomerController@haptaGenerate')->name('hapta_date_store');

    Route::get('slab', 'SlabController@index')->name('slab_list');
    Route::get('slab-add', 'SlabController@add')->name('slab_add');
    Route::post('slab-add', 'SlabController@store')->name('store_slab');
    Route::get('slab-edit/{id}', 'SlabController@edit')->name('slab_edit');
    Route::post('slab-edit', 'SlabController@update')->name('slab_update');

});
