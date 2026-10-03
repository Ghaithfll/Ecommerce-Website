<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function Open_Login(){
        return view('Auth.Login');
    }


    public function Login(Request $request){
        // validate email,password
        $validated = $request->validate([
            'email' => ['email','required', 'max:30'],
            'password' => ['required','min:8','max:30']
        ]);
       
        // attempt a login
        
        if (Auth::attempt($validated)) {
            $user = User::where('email', $validated['email']);
            $request->session()->regenerate(); // regenerate session ID
        }
        else{
            return redirect()->back()->withErrors(['error' => "The provided credentials did'nt match our records"]);
        }
        

        // redirect 
        return redirect()->route('categories');
    }


    public function Open_Signup(){

    return view('Auth.sinup');
    }

    public function Signup(Request $request){
    
    // validate email,password,name
        $validated = $request->validate([
            'name' => ['required','min:3' , 'max:20','string'],
            'email' => ['email','required', 'max:30','unique:users'],
            'password' => ['required','min:8','max:30']
        ]);
       

        // create a user & login
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
        
        Auth::login($user);
        // redirect 
        
        return redirect()->route('categories');
    

    }



    public function Logout(){
        Auth::logout();
        return redirect()->route('categories');
    }


    //Track everything related to users like Cart, checkout, etc
    // test the login
    }
