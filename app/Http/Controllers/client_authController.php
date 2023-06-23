<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class client_authController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('pages.client.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->input('username'),'password' => $request->input('password'),'role' => 'client'])){
            return redirect()->route('client.dashboard');
        }else{
            return redirect()->route('client.login')->withErrors([
                'not_exist' => "The username or/and password are incorrect."
            ]);
        };
    }

    /**
     * Remove the specified resource from storage.
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();

        return redirect()->route('client.dashboard');
    }

    public function create(){
        return view('pages.client.auth.register');
    }

    public function store(Request $request){
         // Create a new user

         $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'username' => $request->input('username'),
            'password' => bcrypt($request->input('password'))
        ]);

        // Redirect or perform any other actions after successful registration
        return redirect()->route('client.login.form')->with('success', 'Account created successfully. Please log in.');
    }
}
