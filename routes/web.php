<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CatagoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CustomerController;

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
//
//
//
//Catagory Model START
//
//
//
Route::get('/catagory', [
    CatagoryController::class, 'indexCatagory'
]);
Route::get('/Catagory_add_view', [
    CatagoryController::class, 'addCatagoryView'
])->name('addCatagoryView');
//Catagory Curd START
Route::post('/catagory_add', [
    CatagoryController::class, 'addCatagory'
])->name('addNewCatagory');
Route::get('/deleteCatagory', [
    CatagoryController::class, 'destroyCatagory'
])->name('deleteCatagory');
Route::get('/updated_view_id', [
    CatagoryController::class, 'updateCatagoryById'
])->name('updateCatagoryById');

Route::post('/updated_id', [
    CatagoryController::class, 'updateCatagory'
])->name('updatedCatagory');
//Catagory Curd END
//Ajax Route
Route::get('/ajax-validation/{catagoryname}', [
    CatagoryController::class, 'ajaxValidation'
])->name('ajax-validation');
//
//
//
//CATAGORY MODEL END
//BRAND MODEL START
//
//
//
//
Route::get('/brand', [
    BrandController::class, 'display'
]);
Route::get('/brand_add_view', [
    BrandController::class, 'addbrandView'
])->name('addbrandView');
//Brand Curd START
Route::post('/add_brand', [
    BrandController::class, 'addBrand'
])->name('addNewBrand');
Route::get('/brand_delete', [
    BrandController::class, 'destroy'
])->name('deleteBrandBtn');
Route::get('/update_brand_view', [
    BrandController::class, 'updateBrandById'
])->name('updateBrandBtn');
Route::post('/update_brand', [
    BrandController::class, 'updateBrand'
])->name('updateBrand');
//Brand Curd END
//Ajax Brand Validatin with Ajax
Route::get('/ajax-validation-brand/{brandName}/{catagoryId}', [
    BrandController::class, 'ajaxValidation'
])->name('ajax-validation-brand');
//
//
//
//BRAND MODEL END
//CUSTOMER MODEL START
//
//
//
Route::get('/customers', [CustomerController::class, 'index']);
//Customer CURD START
Route::get('/create_customer', [CustomerController::class, 'create'])->name('createNewCustomer');
Route::post('/store_customer', [CustomerController::class, 'store'])->name('storeCustomer');
Route::get('/delete_Customer/{id}', [CustomerController::class, 'destroy'])->name('deleteCustomer');
Route::get('/{id}', [CustomerController::class, 'edit'])->name('editCustomer');
Route::patch('/update_Customer', [CustomerController::class, 'update'])->name('updateCustomer');
//Customer CURD END
//Customer Ajax Catagory to Brands
Route::get('/ajax-catogry-brand/{catagoryList}', [CustomerController::class, 'ajaxCatagoryBrand']);
Route::get('/ajax-validation-brand/{customerEmail}', [CustomerController::class, 'ajaxValidation']);
//
//
//
//CUSTOMER MODEL END
