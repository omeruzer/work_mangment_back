<?php

use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepartmanController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\PersonelController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SeasonController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



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
    Route::post('remove/{id}',[CustomerController::class,'remove']);});

    