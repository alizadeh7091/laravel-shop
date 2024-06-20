<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\PostController;


Route::post('/applyDiscount', [DiscountController::class, 'applyDiscount'])->name('apply.discount');
Route::get('/api/post-insert',[PostController::class,'insertPosts']);
