<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\MainSliderController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BookingController;

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

Route::resource('slider', SliderController::class)->middleware(['auth','verified']);
Route::resource('categories', CategoriesController::class)->middleware(['auth','verified']);
Route::resource('product', ProductController::class)->middleware(['auth','verified']);
Route::resource('brand', BrandController::class)->middleware(['auth','verified']);
Route::resource('customer', CustomerController::class)->middleware(['auth','verified']);
Route::resource('mainslider', MainSliderController::class)->middleware(['auth','verified']);
Route::resource('currency', CurrencyController::class)->middleware(['auth','verified']);
Route::resource('services', ServicesController::class)->middleware(['auth','verified']);
Route::resource('profile', ProfileController::class)->middleware(['auth','verified']);
Route::resource('availability', AvailabilityController::class)->middleware(['auth','verified']);
Route::resource('sales', SalesController::class)->middleware(['auth','verified']);
Route::resource('purchase', PurchaseController::class)->middleware(['auth','verified']);
Route::resource('warehouse', WarehouseController::class)->middleware(['auth','verified']);
Route::resource('supplier', SupplierController::class)->middleware(['auth','verified']);
Route::resource('booking', BookingController::class)->middleware(['auth','verified']);

Route::post('updatework',[ServicesController::class,'updateworkstatus'])->middleware(['auth','verified'])->name('service.updateworkhistory');

Route::post('uploadslider',[SliderController::class,'uploadslider'])->middleware(['auth','verified'])->name('uploadslider');
Route::post('uploadbrand',[BrandController::class,'uploadbrand'])->middleware(['auth','verified'])->name('uploadbrand');
Route::post('uploadcategoryslider',[CategoriesController::class,'uploadcategoryslider'])->middleware(['auth','verified'])->name('uploadcategoryslider');
Route::post('uploadproducts',[ProductController::class,'uploadproducts'])->middleware(['auth','verified'])->name('uploadproducts');
Route::post('uploadmainslider',[MainSliderController::class,'uploadmainslider'])->middleware(['auth','verified'])->name('uploadmainslider');
Route::post('bookitem',[InventoryController::class,'bookitems'])->middleware(['auth','verified'])->name('inventory.bookitem');
Route::post('storesales',[InventoryController::class,'storesales'])->middleware(['auth','verified'])->name('inventory.storesales');
Route::post('storeinventory',[InventoryController::class,'store'])->middleware(['auth','verified'])->name('inventory.store');

Route::get('productmedia',[ProductController::class,'productmedia'])->middleware(['auth'],['verified'])->name('getmedia');
Route::get('orders',[OrderController::class,'orders'])->middleware(['auth','verified'])->name('orders');

Route::get('orderdetails',[OrderController::class,'orderdetails'])->middleware(['auth','verified'])->name('orderdetails');

Route::get('servicesdetails/{id}',[ServicesController::class,'servicesdetails'])->middleware(['auth','verified'])->name('servicesdetails');
Route::get('invoice/{id}',[InvoiceController::class,'invoice'])->middleware(['auth','verified'])->name('invoice');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
