<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Socialite;

class AuthController extends Controller
{
    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        $user = Socialite::driver('google')->user();
        $oldUser = User::where('email', $user->email)->first();

        if ($oldUser) {
            Auth::login($oldUser);
            return redirect()->route('home');
        }

        $newUser = User::create([
            'name' => $user->name,
            'email' => $user->email,
        ]);

        Auth::login($newUser);
        return redirect()->route('home');
        
    }
}
