<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\LoginDetails;


class RegisterController extends Controller
{
    //
    public function showRegisterForm() {
        return view('auth.register');
    }

    public function store(Request $request) {
        $request->validate([
            'fullname' => 'required|string|max:100',
            'email' => 'required|string|email|max:100|unique:users',
            'phone_number' => 'required|integer|unique:users|max:999999999',
            'date_of_birth' => 'required|date',
            'gender' => 'required|in:Male,Female',
        ]);

        $nameParts = explode(' ', $request->fullname);
        $initials = '';
        foreach ($nameParts as $part) {
            $initials .= strtoupper(substr($part, 0, 1));
        }
        $username = $initials . rand(100, 999); // Append a random number for uniqueness

        // Generate a strong random password
        $randomPassword = Str::random(8); // You can adjust the password length if needed

        $user = User::create([
            'fullname' => $request->input('fullname'),
            'email' => $request->input('email'),
            'phone_number' => $request->input('phone_number'),
            'date_of_birth' => $request->input('date_of_birth'),
            'gender' => $request->input('gender'),
            'username' => $username,
            'password' => Hash::make($randomPassword),
        ]);

        // Send login details to the user's email using Mailhog
        Mail::to($user->email)->send(new LoginDetails($user, $username, $randomPassword));

        $credentials = $request->only('username', 'password');
        Auth::attempt($credentials);
        $request->session()->regenerate();
        return redirect()->route('dashboard')
        ->withSuccess('You have successfully registered & logged in. Login details have been sent to your email.');
    }
}

