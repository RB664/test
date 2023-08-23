<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function __construct() {
        $this->middleware('guest')->except([
            'logout','dashboard'
        ]);
    }

    public function showLoginForm() {
        return view('auth.login');
    }

    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        $remember_me = $request->has('remember_me') ? true : false;
        
        if(Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard')
            ->withSuccess('You have successfully logged in!');
        }
        return back()->withErrors([
            'username' => 'Your provided credentials do not match in our records'
        ])->onlyInput('username');
    }

    public function dashboard() {
        if(Auth::check()) {
            return view('auth.dashboard');
        }
        return redirect()->route('login')
        ->withErrors([
            'username' => 'Please login to access the dashboard'
        ])->onlyInput('username');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')
        ->withSuccess('You have logged out successfully!');
    }
}
