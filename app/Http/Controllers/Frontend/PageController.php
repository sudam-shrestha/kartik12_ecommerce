<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ClientRequestNotification;
use App\Models\Admin;
use App\Models\Cart;
use App\Models\Client;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Http;
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

    public function checkout($id)
    {
        $client = Client::findOrFail($id);
        return view('frontend.checkout', compact('client'));
    }


    public function order(Request $request, $clientId)
    {
        $request->validate([
            'delivery_address' => 'required|string|max:500',
            'payment_method' => 'required',
        ]);

        $cartItems = auth()->user()->carts()
            ->whereHas('product', fn($q) => $q->where('client_id', $clientId))
            ->with('product')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect()->back()->with('error', 'Cart is empty.');
        }

        $total = $cartItems->sum(
            fn($item) => ($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->qty
        );

        $order = Order::create([
            'user_id' => auth()->id(),
            'client_id' => $clientId,
            'total_amount' => $total,
            'status' => 'pending',
            'delivery_address' => $request->delivery_address,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'qty' => $item->qty,
                'amount' => ($item->product->price - ($item->product->price * $item->product->discount / 100)) * $item->qty,
            ]);
        }

        Payment::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'status' => 'pending',
            'amount' => $total,
        ]);

        $cartItems->each->delete();

        if ($request->payment_method == 'khalti') {
            $response = Http::withHeaders([
                "Authorization" => "Key " . env("KHALTI_SECRET"),
                'Content-Type'  => 'application/json',
            ])->post("https://dev.khalti.com/api/v2/epayment/initiate/", [
                "return_url" => route('khalti_callback'),
                "website_url" => route('home'),
                "amount" => $total * 100,
                "purchase_order_id" => $order->id,
                "purchase_order_name" => "Order #{$order->id}",
            ]);
            if ($response["payment_url"]) {
                Cookie::queue("order_id", $order->id);
                return redirect($response["payment_url"]);
            }
        }

        toast("Order placed successfully", "success");
        return redirect()->route('carts');
    }


    public function khalti_callback(Request $request)
    {
        $order_id = Cookie::get("order_id");
        $order = Order::find($order_id);

        $response = Http::withHeaders([
            "Authorization" => "Key " . env("KHALTI_SECRET"),
            'Content-Type'  => 'application/json',
        ])->post("https://dev.khalti.com/api/v2/epayment/lookup/", [
           "pidx" => $request["pidx"]
        ]);

        $payment = $order->payment;

        $payment->status = $response["status"];
        $payment->save();

        Cookie::forget("order_id");
        toast("Order placed successfully", "success");
        return redirect()->route('carts');
    }
}
