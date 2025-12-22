<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ClientRequestNotification;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class PageController extends BaseController
{
    public function home()
    {
        $clients = Client::where("expire_date", ">=", now())->where('status', 'approved')->get();
        $products = Product::whereIn('client_id', $clients->pluck('id'))->where('stock', true)->get();
        return view('frontend.home', compact('products'));
    }

    public function search(Request $request)
    {
        $q = $request->q;
        $products = Product::orderBy('price', 'asc')->where('stock', true)->where('name', "like", "%$q%")->get();
        return view('frontend.search', compact('products', 'q'));
    }

    public function client_request(Request $request)
    {
        $request->validate([
            'client_name' => 'required|max:100',
            'shop_name' => 'required|max:100',
            'contact' => 'required|unique:clients',
            'email' => 'required|unique:clients',
            'address' => 'required|max:255',
            'terms' => 'required',
        ]);
        $client = new Client();
        $client->name = $request->client_name;
        $client->shop_name = $request->shop_name;
        $client->contact = $request->contact;
        $client->email = $request->email;
        $client->address = $request->address;
        $client->save();

        $admin = Admin::first();

        Mail::to($admin)->send(new ClientRequestNotification($client));

        toast("Request submitted successfully", "success");
        return redirect()->back();
    }


    public function product($id)
    {
        $product = Product::findOrFail($id);
        return view('frontend.product', compact('product'));
    }


    public function cart(Request $request)
    {
        $product = Product::findOrFail($request->product_id);
        $price = $product->price - ($product->price * $product->discount) / 100;
        $cart = new Cart();
        $cart->user_id = Auth::user()->id;
        $cart->product_id = $request->product_id;
        $cart->qty = $request->qty;
        $cart->amount = $request->qty * $price;
        $cart->save();
        toast("Product added to cart", "success");
        return redirect()->back();
    }

    public function carts()
    {
        $user = User::find(Auth::user()->id);
        $cartItems = $user
            ->carts()
            ->with('product.client')
            ->get()
            ->groupBy('product.client_id'); 

        return view('frontend.carts', compact('cartItems'));
    }
}
