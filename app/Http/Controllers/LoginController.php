<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    //
    public function index() 
    {
        return view('auth.login');
    }

    public function store(Request $request) 
    {
        //dd($request->all());
        //dd($request->get('username'));
        
        //validar los datos
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        //autenticar al usuario
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            //return back()->with('status', 'Invalid login details');
            return back()->with('message', 'Credenciales inválidas');
        }

        //redirigir
        return redirect()->route('posts.index', ['user' => auth()->user()->username]);
    }
}
