<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Comentario;
use Illuminate\Http\Request;

class ComentarioController extends Controller
{
    public function store(Request $request, User $user, Post $post)
    {
        //validar el comentario
        $request->validate([
            'comentario' => 'required|max:255',
        ]);

        //guardar el comentario
        Comentario::create([
            'comentario' => $request->comentario,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        //mostrar mensaje y redireccionar
        return back()->with('mensaje', 'Comentario agregado');

    }
}
