@extends('layouts.app')

@section('titulo')
    Crear un nuevo Post
@endsection

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/dropzone/dist/dropzone.css">
@endpush

@section('contenido')

    <div class="md:flex md:items-center">


        <div class="md:w-1/2 px-10">
            
            <form action="{{ route('imagenes.store') }}" method="POST" enctype="multipart/form-data" id="dropzone" class="dropzone border-dashed border-2 w-full h-96 rounded flex flex-col justify-center items-center"  >
                @csrf
                
            </form>
        </div>
        <div class="md:w-1/2 p-10 bg-white  rounded-lg shadow-xl mt-10 md:mt-0">
            <form action="{{ route('posts.store') }}" method="POST" novalidate>
                @csrf 
                <div class="mb-5">
                    <label for="titulo" class="block uppercase text-gray-500  font-bold mb-2">Titulo</label>
                    <input type="text" name="titulo" id="titulo" placeholder="Titulo de la Publicación" class="border rounded-lg w-full p-3 @error('titulo') border-red-500 @enderror" value="{{ old('name') }}">
                    @error('titulo')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror    
                </div>

                <div class="mb-5">
                    <label for="descripcion" class="block uppercase text-gray-500  font-bold mb-2">Descripción</label>
                    <textarea name="descripcion" id="descripcion" placeholder="Descripción de la Publicación" class="border rounded-lg w-full p-3 @error('titulo') border-red-500 @enderror">{{ old('descripcion') }}</textarea>
                    @error('descripcion')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror    
                </div>

                <div class="mb-5">
                
                    <input type="hidden" name="imagen" id="imagen" value="{{ old('imagen') }}">
                    @error('imagen')
                        <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                    @enderror
                </div>

                <input type="submit" value="Publicar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg"/>
                
            </form>
        </div>

    </div>
@endsection