<?php

use App\Http\Controllers\Cart_detailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TestController;
use App\Http\Middleware\CanViewPosts;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::prefix('product')->group(function () {
    Route::get('/all', [ProductController::class, 'allProducts'])->name('all.products');
});

Route::prefix('cart')->group(function () {
    Route::post('/add/{id}', [CartController::class, 'addCart'])->name('add.cart');
});

Route::prefix('cart_detail')->group(function () {
    Route::get('/all', [Cart_detailController::class, 'allCartItems'])->name('all.cart.items');
    Route::post('/delete/{id}', [Cart_detailController::class, 'deleteCartItem'])->name('delete.cart.item');
//    Route::post('/all', [Cart_detailController::class, 'applyDiscount'])->name('apply.discount');
});

Route::middleware('auth')->prefix('order')->group(function () {
    Route::post('/add', [OrderController::class, 'addOrder'])->name('add.order');
});

Route::prefix('post')->group(function () {
    Route::get('/create', [PostController::class, 'createPost'])->name('create.post');
    Route::post('/create', [PostController::class, 'insertPost'])->name('insert.post');
    Route::get('/all', [PostController::class, 'allPost'])->middleware(CanViewPosts::class)->name('all.post');
    Route::post('delete/{id}', [PostController::class, 'deletePost'])->name('delete.post');
    Route::get('/edit/{id}', [PostController::class, 'editPost'])->name('edit.post');
    Route::put('/update/{id}', [PostController::class, 'updatePost'])->name('update.post');
    Route::get('/show/{id}', [PostController::class, 'showPost'])->name('show.post');
});

Route::post('/insert-comment',[CommentController::class,'insertComment'])->name('insert.comment');

Route::get('/test',[TestController::class,'testLog']);

require __DIR__ . '/auth.php';
