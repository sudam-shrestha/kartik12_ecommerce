<?php

use App\Http\Controllers\Frontend\AuthController;
use App\Http\Controllers\Frontend\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Order;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get("/", [PageController::class, "home"])->name("home");
Route::post("/client/request", [PageController::class, "client_request"])->name("client.request");
Route::get("/search", [PageController::class, "search"])->name("search");

Route::get("/product/{id}", [PageController::class, "product"])->name("product");



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::post("/cart", [PageController::class, "cart"])->name("cart");
    Route::get("/carts", [PageController::class, "carts"])->name("carts");
    Route::get("/checkout/{id}", [PageController::class, "checkout"])->name("checkout");
    Route::get("/khalti/callback", [PageController::class, "khalti_callback"])->name("khalti_callback");


    Route::post('/order/place/{client}', [PageController::class, 'order'])->name('order.place');
});


Route::get("/google/redirect", [AuthController::class, "google_redirect"])->name("google_redirect");
Route::get("/google/callback", [AuthController::class, "google_callback"])->name("google_callback");



Route::get('/order/details/{id}', function ($id) {
    $order = Order::findOrFail($id);
    return view('order-details', compact('order'));
})->name('order.show');

require __DIR__ . '/auth.php';
