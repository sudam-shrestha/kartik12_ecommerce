<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\ClientRequestNotification;
use App\Models\Admin;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PageController extends BaseController
{
    public function home()
    {
        return view('frontend.home');
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
}
