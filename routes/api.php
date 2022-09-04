<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CurrentController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmanController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\InvoiceProductsController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductVariantController;
use App\Http\Controllers\ProductVariantStockController;
use App\Http\Controllers\ProductVariantValueController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\SeasonController;
use App\Http\Controllers\StatisticController;
use App\Models\Current;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::post('register',[AuthController::class,'register']);
Route::post('login',[AuthController::class,'login']);
Route::post('logout',[AuthController::class,'logout']);

Route::group(['middleware'=>'auth:sanctum'],function(){
    // USER
    Route::get('user',[AuthController::class,'userInfo']);
    Route::get('logout',[AuthController::class,'logout']);
    Route::post('user-update',[AuthController::class,'userUpdate']);
    Route::post('user-update-pass',[AuthController::class,'userPass']);
    Route::post('shop-logo',[AuthController::class,'shopLogo']);

    // BRANDS
Route::group(['prefix'=>'brand'],function(){
    Route::post('/',[BrandController::class,'index']);
    Route::post('add',[BrandController::class,'add']);
    Route::post('detail/{id}',[BrandController::class,'detail']);
    Route::post('edit/{id}',[BrandController::class,'edit']);
    Route::post('remove/{id}',[BrandController::class,'remove']);
});

// Category
Route::group(['prefix'=>'category'],function(){
    Route::post('/',[CategoryController::class,'index']);
    Route::post('add',[CategoryController::class,'add']);
    Route::post('detail/{id}',[CategoryController::class,'detail']);
    Route::post('edit/{id}',[CategoryController::class,'edit']);
    Route::post('remove/{id}',[CategoryController::class,'remove']);
});

// Departman
Route::group(['prefix'=>'departman'],function(){
    Route::post('/',[DepartmanController::class,'index']);
    Route::post('add',[DepartmanController::class,'add']);
    Route::post('detail/{id}',[DepartmanController::class,'detail']);
    Route::post('edit/{id}',[DepartmanController::class,'edit']);
    Route::post('remove/{id}',[DepartmanController::class,'remove']);
});

// Personel
Route::group(['prefix'=>'personel'],function(){
    Route::post('/',[PersonelController::class,'index']);
    Route::post('add',[PersonelController::class,'add']);
    Route::post('detail/{id}',[PersonelController::class,'detail']);
    Route::post('edit/{id}',[PersonelController::class,'edit']);
    Route::post('remove/{id}',[PersonelController::class,'remove']);
});

// Material
Route::group(['prefix'=>'material'],function(){
    Route::post('/',[MaterialController::class,'index']);
    Route::post('add',[MaterialController::class,'add']);
    Route::post('detail/{id}',[MaterialController::class,'detail']);
    Route::post('edit/{id}',[MaterialController::class,'edit']);
    Route::post('remove/{id}',[MaterialController::class,'remove']);
});

// Pattern
Route::group(['prefix'=>'pattern'],function(){
    Route::post('/',[PatternController::class,'index']);
    Route::post('add',[PatternController::class,'add']);
    Route::post('detail/{id}',[PatternController::class,'detail']);
    Route::post('edit/{id}',[PatternController::class,'edit']);
    Route::post('remove/{id}',[PatternController::class,'remove']);
});

// Season
Route::group(['prefix'=>'season'],function(){
    Route::post('/',[SeasonController::class,'index']);
    Route::post('add',[SeasonController::class,'add']);
    Route::post('detail/{id}',[SeasonController::class,'detail']);
    Route::post('edit/{id}',[SeasonController::class,'edit']);
    Route::post('remove/{id}',[SeasonController::class,'remove']);
});

// Product
Route::group(['prefix'=>'product'],function(){
    Route::post('/all',[ProductController::class,'all']);
    Route::post('/',[ProductController::class,'index']);
    Route::post('add',[ProductController::class,'add']);
    Route::post('detail/{id}',[ProductController::class,'detail']);
    Route::post('edit/{id}',[ProductController::class,'edit']);
    Route::post('remove/{id}',[ProductController::class,'remove']);
});
// Note
Route::group(['prefix'=>'note'],function(){
    Route::post('/',[NoteController::class,'index']);
    Route::post('add',[NoteController::class,'add']);
    Route::post('remove/{id}',[NoteController::class,'remove']);
});

// Customer
Route::group(['prefix'=>'customer'],function(){
    Route::post('/',[CustomerController::class,'index']);
    Route::post('add',[CustomerController::class,'add']);
    Route::post('detail/{id}',[CustomerController::class,'detail']);
    Route::post('edit/{id}',[CustomerController::class,'edit']);
    Route::post('remove/{id}',[CustomerController::class,'remove']);
});

// Customer
Route::group(['prefix'=>'current'],function(){
    Route::post('/',[CurrentController::class,'index']);
    Route::post('add',[CurrentController::class,'add']);
    Route::post('detail/{id}',[CurrentController::class,'detail']);
    Route::post('edit/{id}',[CurrentController::class,'edit']);
    Route::post('remove/{id}',[CurrentController::class,'remove']);
    Route::post('current-count',[CurrentController::class,'currentCount']);

});

// Invoice
Route::group(['prefix'=>'invoice'],function(){
    Route::post('/',[InvoiceController::class,'index']);
    Route::post('add',[InvoiceController::class,'add']);
    Route::post('detail/{id}',[InvoiceController::class,'detail']);
    Route::post('edit/{id}',[InvoiceController::class,'edit']);
    Route::post('remove/{id}',[InvoiceController::class,'remove']);
});

// Invoice Product
Route::group(['prefix'=>'invoice-product'],function(){
    Route::post('/',[InvoiceProductsController::class,'index']);
    Route::post('add',[InvoiceProductsController::class,'add']);
    Route::post('detail/{id}',[InvoiceProductsController::class,'detail']);
    Route::post('edit/{id}',[InvoiceProductsController::class,'edit']);
    Route::post('remove/{id}',[InvoiceProductsController::class,'remove']);
});
// Invoice
Route::group(['prefix'=>'invoice'],function(){
    Route::post('/',[InvoiceController::class,'index']);
    Route::post('add',[InvoiceController::class,'add']);
    Route::post('detail/{id}',[InvoiceController::class,'detail']);
    Route::post('edit/{id}',[InvoiceController::class,'edit']);
    Route::post('remove/{id}',[InvoiceController::class,'remove']);
});

// statistic
Route::group(['prefix'=>'statistic'],function(){
    Route::post('/item-count',[StatisticController::class,'itemCounts']);
    Route::post('/declining-product-stock',[StatisticController::class,'decliningProductStock']);
    Route::post('/top-customer',[StatisticController::class,'topCustomer']);
    Route::post('/daily-sell',[StatisticController::class,'dailySell']);
    Route::post('/mounthly-sell',[StatisticController::class,'mounthlySell']);
    Route::post('/last-invoices',[StatisticController::class,'lastInvoices']);
    Route::post('/reports-sell-return',[StatisticController::class,'dailySell']);
});

// reports
Route::group(['prefix'=>'reports'],function(){
    Route::post('/reports-sell-return-daily',[ReportsController::class,'getReportsSellReturnDaily']);
    Route::post('/reports-sell-return-mounthly',[ReportsController::class,'getReportsSellReturnMounthly']);
    Route::post('/reports-brand',[ReportsController::class,'brandReport']);
    Route::post('/reports-category',[ReportsController::class,'categoryReport']);
    Route::post('/reports-pattern',[ReportsController::class,'patternReport']);
    Route::post('/reports-material',[ReportsController::class,'materialReport']);
});



    Route::group(['prefix'=>'variant'],function(){
    Route::post('/',[ProductVariantController::class,'index']);
    Route::post('add',[ProductVariantController::class,'add']);
    Route::post('detail/{id}',[ProductVariantController::class,'detail']);
    Route::post('edit/{id}',[ProductVariantController::class,'edit']);
    Route::post('remove/{id}',[ProductVariantController::class,'remove']);});

    Route::group(['prefix'=>'variantvalue'],function(){
    Route::post('/',[ProductVariantValueController::class,'index']);
    Route::post('add',[ProductVariantValueController::class,'add']);
    Route::post('detail/{id}',[ProductVariantValueController::class,'detail']);
    Route::post('edit/{id}',[ProductVariantValueController::class,'edit']);
    Route::post('remove/{id}',[ProductVariantValueController::class,'remove']);});

Route::group(['prefix'=>'variantstock'],function(){
    Route::post('/',[ProductVariantStockController::class,'index']);
    Route::post('add',[ProductVariantStockController::class,'add']);
    Route::post('detail/{id}',[ProductVariantStockController::class,'detail']);
    Route::post('edit/{id}',[ProductVariantStockController::class,'edit']);
    Route::post('remove/{id}',[ProductVariantStockController::class,'remove']);});

});
