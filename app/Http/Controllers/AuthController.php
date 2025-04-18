<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{

    // Show the login form
    public function index()
    {
        return view('auth.login');
    }

    // Handle the login form submission
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Get the user data
        $userDetails = [
            'email'    => $request->email,
            'password' => $request->password
        ];

        // Attempt to log the user in
        if (Auth::attempt($userDetails)) {
            $request->session()->regenerate();
            // Send the user to the home page if he logged in
            return redirect('/books');
        }
        
        // If unsuccessful, return back to the form
        return back()->withErrors([
            'email' => 'Invalid credentials provided.',
        ]);
    }

    // Show the registration form
    public function register()
    {
        return view('auth.register');
    }

    // Handle the registration form submission
    public function storeRegisteredUser(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'confirmed', 'min:6'],
        ]);

        // Create a new user
        // By default, newly registered users will have role_id = 1 (normal user)
        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role_id'  => 1,
        ]);

        // Log the user in 
        Auth::login($user);

        // Redirect them to the home page
        return redirect('/books');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
