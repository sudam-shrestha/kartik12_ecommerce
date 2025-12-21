<?php

use App\Http\Controllers\Frontend\PageController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

// Route::get('/password', function () {
//     return Hash::make("codeit123");
// });


Route::get("/",[PageController::class,"home"])->name("home");
Route::post("/client/request",[PageController::class,"client_request"])->name("client.request");
Route::get("/search",[PageController::class,"search"])->name("search");

Route::get("/product/{id}",[PageController::class,"product"])->name("product");
