@extends('layouts.app')

@section('titulo')
    Perfil: {{ $user->name }}
@endsection

@section('contenido')

    <div class="flex justify-center">
        <div class="w-full md:w-8/12 lg:w-6/12 flex flex-col items-center md:flex-row">
            <div class="md:w-8/12 lg:w-6/12 px-5">
                <img src="{{ $user->imagen ? asset('perfiles').'/'.$user->imagen : asset('img/usuario.svg') }}" alt="Imagen de perfil de {{ $user->name }}" class="rounded-full  w-32 h-32 md:w-48 md:h-48  object-cover object-center">
                
            </div>
            <div class="flex-col flex items-center md:justify-center md:w-8/12 lg:w-6/12 px-5 py-10 md:my-10 md:items-start">
                <div class="flex item gap-2">
                    <p class="text-gray-700 text-2xl">{{ $user->name }}</p>

                    @auth
                        @if(auth()->user()->id == $user->id)
                            <a href="{{ route('perfil.index') }}"
                             class="text-gray-500 hover:text-gray-600 cursor-pointer"><svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                            </a>
                        @endif
                    @endauth
                </div>

                <p class="text-gray-800 text-sm mb-3 font-bold mt-5">
                    {{ $user->follower->count() }}
                    <span class="font-normal">@choice('Seguidor|Seguidores', $user->follower->count())</span>
                </p> 
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $user->following->count() }}
                    <span class="font-normal">@choice('Seguido|Seguidos', $user->following->count())</span>
                </p>     
                
                <p class="text-gray-800 text-sm mb-3 font-bold">
                    {{ $posts->count() }}
                    <span class="font-normal">Posts</span>
                </p>

                @auth

                    @if(auth()->user()->id != $user->id)

                        @if(!$user->siguiendo(auth()->user()))
                            <form action="{{ route('users.follow', $user) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-sky-600 hover:bg-sky-700 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg text-xs">Seguir</button>
                            </form>
                        @else
                            <form action="{{ route('users.unfollow', $user) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit"   class="bg-red-500 hover:bg-red-600 transition-colors cursor-pointer uppercase w-full text-white font-bold p-3 rounded-lg text-xs">Dejar de Seguir</button>
                            </form>
                            
                            
                        @endif

                    @endif
                   
                @endauth

            </div>
        </div>
    </div>

    <section class="mt-10 container mx-auto">
        <h2 class="text-4xl font-black text-center my-10 ">Publicaciones</h2>

        <x-listar-post :posts="$posts" />
    </section>
@endsection

