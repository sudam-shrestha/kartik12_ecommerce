<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Color;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class BaseController extends Controller
{
    public function __construct()
    {
        $color = Color::first();
        $carts = Cart::where("user_id", Auth::user()?->id)->get();
        View::share([
            "color" => $color,
            "carts" => $carts
        ]);
    }
}
