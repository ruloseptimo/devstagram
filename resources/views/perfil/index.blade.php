@extends('layouts.app')

@section('titulo')
    Editar Perfil: {{ auth()->user()->username }}
@endsection

@section('contenido')

    <div class="md:flex md:justify-center">
        <div class="md:w-1/2 bg-white p-6">
            <form class="mt-10 md:mt-0" action="{{ route('perfil.store') }}" method="POST" enctype="multipart/form-data">

                @csrf 
                <div class="mb-5">
                    <label for="name" class="block uppercase text-gray-500  font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario" class="border rounded-lg w-full p-3 @error('username') border-red-500 @enderror" value="{{ auth()->user()->username }}">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror    
                </div>

                <div class="mb-5">
                    <label for="imagen" class="block uppercase text-gray-500  font-bold mb-2">Imagen Perfil</label>
                    <input type="file" name="imagen" id="imagen" class="border rounded-lg w-full p-3" accept="image/*">
                    @error('username')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror    
                </div>

                <input type="submit" value="Guardar Cambios" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg"/>
            </form>
        </div>
    </div>
            

@endsection