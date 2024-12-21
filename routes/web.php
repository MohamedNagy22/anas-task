<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WebhookController;

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

require __DIR__.'/auth.php';





### Admin Routes
Route::middleware(['is.admin', 'auth', 'log.request'])->group(function () {
    Route::get('/all-products', [ProductController::class, 'allProducts']);                               //Responsible for showing all Products for the admin
    Route::post('/store-products', [ProductController::class, 'storeProduct'])->name('store.product');    //Responsible for adding a new product
    Route::get('/product/{id}', [ProductController::class, 'showSpecificProduct']);                       //Responsible for finding the product with the id number that will be written in the url
    Route::get('/product-greater-than/{price}', [ProductController::class, 'expensiveProduct']);          //Responsible for display the products the its price greater than the price that will be written in the url
});

### Authenticated User Routes
Route::middleware(['auth', 'log.request'])->group(function () {
    Route::get('/user-all-products', [ProductController::class, 'allProducts']);            //Responsible for displaying all products for the user
});

Route::get('/pay', [PaymentController::class, 'showForm'])->name('payment.form');
Route::post('/process-payment', [PaymentController::class, 'processPayment'])->name('payment.process');
Route::get('/payment-confirmation', [PaymentController::class, 'confirmation'])->name('payment.confirmation');

Route::post('/stripe/webhook', [WebhookController::class, 'handleWebhook']);

//Card Number for test
//4242 4242 4242 4242

//users
//user@gmail.com
//123456789user

//admin@gmail.com
//123456789admin