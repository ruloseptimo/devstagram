@extends('layouts.app')

@section('titulo')
    {{ $post->titulo }}

@endsection

@section('contenido')
    <div class="container mx-auto md:flex">
        <div class="md:w-1/2">
            <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="Imagen de publicación de {{ $post->titulo }}" >

            <div class="p-3 flex items-center gap-4">
                @auth
                    <livewire:like-post :post="$post" />
                @endauth
            </div>
            <div >
                <p class="font-bold">{{ $post->user->username }}</p>
                <p class="text-sm text-gray-500 " >{{ $post->created_at->diffForHumans() }}</p>
                <p class="mt-5">{{ $post->descripcion }}</p>

            </div>

            <!-- Eliminar publicación para usuario autenticado y dueño de la publicación -->
            @auth    
                @if (auth()->user()->id == $post->user_id)     
                    <form action="{{ route('posts.destroy', $post) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Eliminar Publicación" class="bg-red-500 hover:bg-red-600 cursor-pointer  p-2 mt-4  text-white font-bold rounded-lg"/>
                    </form>
                @endif
            @endauth
        </div>

       

        <div class="md:w-1/2 p-5">
            <div class="shadow bg-white p-5 mb-5 rounded-lg">
                @auth   
                    <p class="text-xl font-bold text-center mb-4">Agregar un comentario</p>

                    @if (session('mensaje'))
                        <div class="bg-green-500 text-white rounded-lg text-sm p-2 mb-6 text-center uppercase font-bold">
                            {{ session('mensaje') }}
                        </div>                 
                    @endif

                    <form action="{{ route('comentarios.store',['post' => $post ,'user' => $user]) }}" method="POST">
                        @csrf
                        
                        <div class="mb-5">
                            <label for="comentario" class="block uppercase text-gray-500  font-bold mb-2">Comentario</label>
                            <textarea name="comentario" id="comentario" placeholder="Agregar un comentario" class="border rounded-lg w-full p-3 @error('comentario') border-red-500 @enderror"></textarea>
                            @error('comentario')
                                <p class="bg-red-500 text-white my-2 rounded-lg text-sm p-2 text-center">{{ $message }}</p>
                            @enderror    
                        </div>
                        
                        <input type="submit" value="Comentar" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg"/>
                    </form>
                @endauth

                
                <div class="bg-white shadow mb-5 max-h-96 overflow-y-auto mt-10 rounded-lg">
                    @if ($post->comentarios->count())
                        
                        

                        @foreach ($post->comentarios as $comentario)
                            <div class="p-5 border-gray-300 border-b">
                                <a href="{{ route('posts.index', $comentario->user) }}" class="font-bold">{{ $comentario->user->username }}</a>
                                <p >{{ $comentario->comentario }}</p>
                                <p class="text-sm text-gray-500">{{ $comentario->created_at->diffForHumans() }}</p>
                                
                            </div>
                        @endforeach
                    
                    @else
                        <p class="text-center uppercase text-gray-600 text-sm font-bold">No hay comentarios aún</p>
                    @endif

                    
                </div>    

                            
            </div>
        </div>
    </div>
@endsection