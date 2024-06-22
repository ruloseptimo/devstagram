<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    //
    public function index() 
    {
        return view('auth.register');
    }

    public function store(Request $request) 
    {
        //dd($request->all());
        //dd($request->get('username'));
        
        //modificar el request
        $request->merge([
            'username' => Str::slug($request->username),
        ]);

        //validar los datos
        $request->validate([
            'name' => 'required',
            'username' => 'required|min:4|max:20|unique:users',
            'email' => 'required|email|unique:users|max:60',
            'password' => 'required|confirmed|min:6|max:20',
        ]);

        //crear un usuario
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        //autenticar al usuario
        auth()->login($user);
        

        //redirigir
        return redirect()->route('posts.index');
    }
        
}
