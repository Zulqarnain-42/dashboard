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
Route::resource('customer', CustomerController::class);
Route::resource('mainslider', MainSliderController::class);

Route::post('uploadslider',[SliderController::class,'uploadslider'])->middleware(['auth','verified'])->name('uploadslider');
Route::post('removeslider',[SliderController::class,'removeslider'])->middleware(['auth','verified'])->name('removeslider');
Route::post('uploadbrand',[BrandController::class,'uploadbrand'])->middleware(['auth','verified'])->name('uploadbrand');
Route::post('removebrand',[BrandController::class,'removebrand'])->middleware(['auth','verified'])->name('removebrand');
Route::post('uploadcategoryslider',[CategoriesController::class,'uploadcategoryslider'])->middleware(['auth','verified'])->name('uploadcategoryslider');
Route::post('removecategoryslider',[CategoriesController::class,'removecategoryslider'])->middleware(['auth','verified'])->name('removecategoryslider');
Route::post('uploadproducts',[ProductController::class,'uploadproducts'])->middleware(['auth','verified'])->name('uploadproducts');
Route::post('removeproducts',[ProductController::class,'removeproducts'])->middleware(['auth','verified'])->name('removeproducts');
Route::post('uploadmainslider',[MainSliderController::class,'uploadmainslider'])->middleware(['auth','verified'])->name('uploadmainslider');
Route::post('removemainslider',[MainSliderController::class,'removemainslider'])->middleware(['auth','verified'])->name('removemainslider');
Route::get('warehouse',[InventoryController::class,'warehouse'])->middleware(['auth','verified'])->name('inventory.warehouse');
Route::get('booking',[InventoryController::class,'booking'])->middleware(['auth','verified'])->name('inventory.booking');

Route::get('orders',[OrderController::class,'orders'])->middleware(['auth','verified'])->name('orders');
Route::get('services',[ServicesController::class,'services'])->middleware(['auth','verified'])->name('services');
Route::get('orderdetails',[OrderController::class,'orderdetails'])->middleware(['auth','verified'])->name('orderdetails');

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
