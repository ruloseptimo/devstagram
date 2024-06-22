<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;

class PerfilController extends Controller
{

    public static function middleware(): array
    {
        return [
            new Middleware('auth', except: ['show', 'index']),
        ];
    }
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        return view('perfil.index');
    }

    public function store(Request $request)
    {

        //modificar el request
        $request->merge([
            'username' => Str::slug($request->username),
        ]);

        //validar los datos
        $request->validate([       
            'username' => 'required|min:4|max:20|unique:users,username,'.auth()->user()->id.'|not_in:editar-perfil',
        ]);

        if($request->imagen != null){
            $request->validate([
                'imagen' => 'image|max:2048',
            ]);

            $manager = new ImageManager(new Driver());
        
            $imagen = $request->file('imagen');

            $nombreImagen = Str::uuid() . '.' . $imagen->extension();

            $imagenServidor = $manager->read($imagen);
            $imagenServidor->resize(1000, 1000, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

            $imagenPath = public_path('perfiles') . '/' . $nombreImagen;

            $imagenServidor->save($imagenPath);
        }

       //guardo cambios 
        $usuario = User::find(auth()->user()->id); 

        $usuario->username = $request->username;
        $usuario->imagen = $nombreImagen ?? $usuario->imagen ?? null;

        $usuario->save();

        //redirigir
        return redirect()->route('posts.index', $usuario->username);
    }
}
