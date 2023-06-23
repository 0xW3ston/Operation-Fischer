<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class admin_authController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // User::create([
        //     "username" => "admin_nigga",
        //     "name" => "ahmed oufqir",
        //     "role" => "admin",
        //     "email" => "nigga@gmail.com",
        //     "password" => "1234"
        // ]);
        return view('pages.admin.auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['username' => $request->input('username'),'password' => $request->input('password'),'role' => 'admin'])){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login.form')->withErrors([
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
        return redirect()->route('admin.dashboard');
    }
}
