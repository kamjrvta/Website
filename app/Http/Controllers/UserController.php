<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;

use Illuminate\Validation\Rule;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registration()
    {
       
        return view('registration.form');
    } 

    public function store(Request $req)
    {
      //@dd($req);
      $validated=$req->validate([

        "name"=>['required','min:4'],
        "email"=>['required', 'email', Rule::unique('users', 'email')],
        "password"=>'required|confirmed|min:6'

      ]);

      $validated['password']=Hash::make($validated['password']);
      $user=User::create($validated);
      return redirect("/");
        
    } 
}
