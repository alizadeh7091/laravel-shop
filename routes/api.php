<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DiscountController;

Route::post('/all', [DiscountController::class, 'applyDiscount'])->name('apply.discount');
