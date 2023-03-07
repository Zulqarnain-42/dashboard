<?php

use App\Http\Controllers\AttributeController;
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
use App\Http\Controllers\BrandCategoriesController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\SettingController;

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

Route::resource('slider', SliderController::class)->middleware(['auth','verified','role:admin']);
Route::post('changesliderstatus/{sliderid}',[SliderController::class,'changesliderstatus'])->middleware(['auth','verified']);

Route::resource('categories', CategoriesController::class)->middleware(['auth','verified']);
Route::post('changecategoriesstatus/{categoryid}',[CategoriesController::class,'çhangecategoriesstatus'])->middleware(['auth','verified']);
Route::post('changecategoriesfeatured/{categoryid}',[CategoriesController::class,'changecategoriesfeatured'])->middleware(['auth','verified']);
Route::post('uploadcategoryimage',[CategoriesController::class,'uploadcategoryimage'])->middleware(['auth','verified'])->name('uploadcategoryimage');
Route::post('uploadcategoryslider',[CategoriesController::class,'uploadcategoryslider'])->middleware(['auth','verified'])->name('uploadcategoryslider');

Route::resource('product', ProductController::class)->middleware(['auth','verified']);
Route::get('check-model',[ProductController::class,'checkmodel'])->middleware(['auth','verified'])->name('product.check-model');
Route::post('editprice',[ProductController::class,'editprice'])->middleware(['auth','verified'])->name('product.editprice');
Route::post('editweight',[ProductController::class,'editweight'])->middleware(['auth','verified'])->name('product.editweight');
Route::post('uploadproducts',[ProductController::class,'uploadproducts'])->middleware(['auth','verified'])->name('uploadproducts');
Route::post('uploadthumbnail',[ProductController::class,'uploadthumbnail'])->middleware(['auth','verified'])->name('uploadthumbnail');
Route::get('productmedia',[ProductController::class,'productmedia'])->middleware(['auth'],['verified'])->name('getmedia');
Route::post('changeproductstatus/{productid}',[ProductController::class,'changeproductstatus'])->middleware('auth','verified');
Route::post('makefeatured/{productid}',[ProductController::class,'makefeatured'])->middleware('auth','verified');
Route::resource('setting',SettingController::class)->middleware(['auth','verified']);
Route::resource('brand', BrandController::class)->middleware(['auth','verified']);
Route::post('changebrandstatus/{brandid}',[BrandController::class,'changebrandstatus'])->middleware(['auth','verified']);
Route::post('uploadbrand',[BrandController::class,'uploadbrand'])->middleware(['auth','verified'])->name('uploadbrand');

Route::resource('customer', CustomerController::class)->middleware(['auth','verified','role:admin']);
Route::resource('currency', CurrencyController::class)->middleware(['auth','verified','role:admin']);
Route::post('changecurrencystatus/{currencyid}',[CurrencyController::class,'changecurrencystatus'])->middleware(['auth','verified']);
Route::resource('services', ServicesController::class)->middleware(['auth','verified']);
Route::resource('profile', ProfileController::class)->middleware(['auth','verified']);
Route::resource('promotions',PromotionController::class)->middleware(['auth','verified']);
Route::resource('availability', AvailabilityController::class)->middleware(['auth','verified','role:admin']);
Route::post('changeavailabilitystatus/{availabilityid}',[AvailabilityController::class,'changeavailabilitystatus'])->middleware(['auth','verified']);
Route::resource('sales', SalesController::class)->middleware(['auth','verified']);
Route::resource('purchase', PurchaseController::class)->middleware(['auth','verified']);
Route::resource('warehouse', WarehouseController::class)->middleware(['auth','verified','role:admin']);
Route::resource('supplier', SupplierController::class)->middleware(['auth','verified']);
Route::resource('booking', BookingController::class)->middleware(['auth','verified']);
Route::resource('users',UserController::class)->middleware(['auth','verified','role:admin']);
Route::post('changeuserstatus/{userid}',[UserController::class,'changeuserstatus'])->middleware('auth','verified');
Route::resource('permissions',PermissionController::class)->middleware(['auth','verified','role:admin']);
Route::resource('roles',RolesController::class)->middleware(['auth','verified','role:admin']);
Route::resource('company',CompanyController::class)->middleware(['auth','verified','role:admin']);
Route::post('changebrandcategorystatus/{brandcategoryid}',[BrandCategoriesController::class,'changebrandcategorystatus'])->middleware(['auth','verified']);
Route::post('makebrandfeatured/{brandid}',[BrandController::class,'makebrandfeatured'])->middleware(['auth','verified']);

Route::post('updatework',[ServicesController::class,'updateworkstatus'])->middleware(['auth','verified'])->name('service.updateworkhistory');
Route::get('servicesdetails/{id}',[ServicesController::class,'servicesdetails'])->middleware(['auth','verified'])->name('servicesdetails');

Route::post('updateproductavailability/{id}',[InventoryController::class,'updateproductavailability'])->middleware(['auth','verified'])->name('stock.updateproductavailability');
Route::get('opening',[InventoryController::class,'opening'])->middleware(['auth','verified'])->name('stock.opening');

Route::post('uploadsliderone',[SliderController::class,'uploadsliderone'])->middleware(['auth','verified'])->name('uploadsliderone');
Route::post('uploadslidertwo',[SliderController::class,'uploadslidertwo'])->middleware(['auth','verified'])->name('uploadslidertwo');

Route::post('uploadprofile',[UserController::class,'uploadprofile'])->middleware(['auth','verified'])->name('user.profileupload');




Route::get('orders',[OrderController::class,'orders'])->middleware(['auth','verified','role:admin'])->name('orders');
Route::get('orderdetails',[OrderController::class,'orderdetails'])->middleware(['auth','verified','role:admin'])->name('orderdetails');
Route::get('invoice',[OrderController::class,'invoice'])->middleware(['auth','verified'])->name('invoice');
// Route::get('invoice/{id}',[InvoiceController::class,'invoice'])->middleware(['auth','verified','role:admin'])->name('invoice');

Route::get('/', [HomeController::class,'home'])->middleware(['auth','verified'])->name('dashboard');

require __DIR__.'/auth.php';
