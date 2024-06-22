@extends('layouts.app')

@section('titulo')
    Registro en DevStagram
@endsection

@section('contenido')
    <div class="md:flex md:justify-center md:gap-10 md:items-center">
        <div class="md:w-6/12 p-5">
            <img src="{{ asset('img/registrar.jpg') }}" alt="Registro" class="w-full">
        </div>

        <div class="md:w-4/12 bg-white p-6 rounded-lg shadow-xl">
            <form action="{{ route('register') }}" method="POST" novalidate>
                @csrf 
                <div class="mb-5">
                    <label for="name" class="block uppercase text-gray-500  font-bold mb-2">Nombre</label>
                    <input type="text" name="name" id="name" placeholder="Tu Nombre" class="border rounded-lg w-full p-3 @error('name') border-red-500 @enderror" value="{{ old('name') }}">
                    @error('name')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror    
                </div>
                <div class="mb-5">
                    <label for="username" class="block uppercase text-gray-500  font-bold mb-2">Username</label>
                    <input type="text" name="username" id="username" placeholder="Tu Nombre de Usuario" class="border rounded-lg w-full p-3 @error('username') border-red-500 @enderror" value="{{ old('username') }}">
                   
                </div>
                @error('username')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
                <div class="mb-5">
                    <label for="email" class="block uppercase text-gray-500  font-bold mb-2">Email</label>
                    <input type="email" name="email" id="email" placeholder="ejemplo@ejemplo.com" class="border rounded-lg w-full p-3 @error('email') border-red-500 @enderror" value="{{ old('email') }}">  
                </div>
                @error('email')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>  
                @enderror
                <div class="mb-5">
                    <label for="password" class="block uppercase text-gray-500  font-bold mb-2">Contraseña</label>
                    <input type="password" name="password" id="password" placeholder="Tu Contraseña" class="border rounded-lg w-full p-3 @error('password') border-red-500 @enderror" value="{{ old('password') }}">
                   
                </div>
                @error('password')
                    <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                @enderror
                <div class="mb-5">
                    <label for="password_confirmation" class="block uppercase text-gray-500  font-bold mb-2">Confirmar Contraseña</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirma tu Contraseña" class="border rounded-lg w-full p-3 ">
                </div>
                <input type="submit" value="Crear Cuenta" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg"/>
            </form>
        </div>
@endsection