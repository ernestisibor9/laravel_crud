<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\PayPalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// Routes for showing products in tabular form
Route::get('/', [ProductController::class, 'Index']);


// Routes for storing products into the database
Route::post('/store/product', [ProductController::class, 'StoreProduct'])->name('store.product');

// Route for updating products in the database
Route::post('/update/product/', [ProductController::class, 'UpdateProduct'])->name('update.product');

// Route for deleting products from the database
Route::get('/delete/product/{id}', [ProductController::class, 'DeleteProduct'])->name('delete.product');

// Route for invoice and generating pdf
Route::get('/download.invoice/{id}', [ProductController::class, 'DownloadProduct'])->name('download.invoice');

// PayPal routes
Route::post('/buy/product/paypal', [PayPalController::class, 'PayPal'])->name('paypal');
Route::get('/success', [PayPalController::class, 'Success'])->name('success');
Route::post('/cancel', [PayPalController::class, 'Cancel'])->name('cancel');
