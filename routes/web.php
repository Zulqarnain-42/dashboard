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
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AvailabilityController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;

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
Route::resource('currency', CurrencyController::class)->middleware(['auth','verified']);
Route::resource('services', ServicesController::class)->middleware(['auth','verified']);
Route::resource('profile', ProfileController::class)->middleware(['auth','verified']);
Route::resource('availability', AvailabilityController::class)->middleware(['auth','verified']);
Route::resource('sales', SalesController::class)->middleware(['auth','verified']);
Route::resource('purchase', PurchaseController::class)->middleware(['auth','verified']);
Route::resource('warehouse', WarehouseController::class)->middleware(['auth','verified']);
Route::resource('supplier', SupplierController::class)->middleware(['auth','verified']);
Route::resource('booking', BookingController::class)->middleware(['auth','verified']);
Route::resource('users',UserController::class)->middleware(['auth','verified']);
Route::resource('permissions',PermissionController::class)->middleware(['auth','verified']);
Route::resource('roles',RolesController::class)->middleware(['auth','verified']);

Route::post('updatework',[ServicesController::class,'updateworkstatus'])->middleware(['auth','verified'])->name('service.updateworkhistory');
Route::get('inventory-manage',[InventoryController::class,'warehouse'])->middleware(['auth','verified'])->name('inventory.warehouse');
Route::post('add-shipment',[InventoryController::class,'quantity'])->middleware(['auth','verified'])->name('inventory.shipment');
Route::post('uploadslider',[SliderController::class,'uploadslider'])->middleware(['auth','verified'])->name('uploadslider');
Route::post('uploadbrand',[BrandController::class,'uploadbrand'])->middleware(['auth','verified'])->name('uploadbrand');
Route::post('uploadcategoryslider',[CategoriesController::class,'uploadcategoryslider'])->middleware(['auth','verified'])->name('uploadcategoryslider');
Route::post('uploadcategoryimage',[CategoriesController::class,'uploadcategoryimage'])->middleware(['auth','verified'])->name('uploadcategoryimage');
Route::post('uploadproducts',[ProductController::class,'uploadproducts'])->middleware(['auth','verified'])->name('uploadproducts');
Route::post('uploadthumbnail',[ProductController::class,'uploadthumbnail'])->middleware(['auth','verified'])->name('uploadthumbnail');
Route::post('storeinventory',[InventoryController::class,'store'])->middleware(['auth','verified'])->name('inventory.store');

Route::get('check-model',[ProductController::class,'checkmodel'])->middleware(['auth','verified'])->name('product.check-model');

Route::get('productmedia',[ProductController::class,'productmedia'])->middleware(['auth'],['verified'])->name('getmedia');
Route::get('orders',[OrderController::class,'orders'])->middleware(['auth','verified'])->name('orders');

Route::get('orderdetails',[OrderController::class,'orderdetails'])->middleware(['auth','verified'])->name('orderdetails');

Route::get('servicesdetails/{id}',[ServicesController::class,'servicesdetails'])->middleware(['auth','verified'])->name('servicesdetails');
Route::get('invoice/{id}',[InvoiceController::class,'invoice'])->middleware(['auth','verified'])->name('invoice');

Route::get('stock_adjustment',[InventoryController::class,'adjustment'])->middleware(['auth','verified'])->name('inventory.stock_adjustment');
Route::get('add_adjustment',[InventoryController::class,'storeadjustment'])->middleware(['auth','verified'])->name('inventory.storeadjustment');
Route::get('sales',[InventoryController::class,'salesinventory'])->middleware(['auth','verified'])->name('inventory.salesinventory');
Route::get('purchases',[InventoryController::class,'purchases'])->middleware(['auth','verified'])->name('inventory.purchaseinventory');
Route::get('opening',[InventoryController::class,'opening'])->middleware(['auth','verified'])->name('stock.opening');
Route::get('opening_stock_brand/{id}',[InventoryController::class,'brandopening'])->middleware(['auth','verified'])->name('stock.brandopening');


Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
