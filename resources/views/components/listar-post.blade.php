<div>
    @if ($posts->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-6 gap-6">
                    
            @foreach ($posts as $post)
                <div>
                    <a href="{{ route('posts.show', ['post' => $post->id, 'user' => $post->user->username]) }}">
                        <img src="{{ asset('uploads').'/'.$post->imagen }}" alt="Imagen de publicación de {{ $post->titulo }}" />
                    </a>
                
                </div>
                
            @endforeach
        </div>

        <div class="mt-10">
            {{ $posts->links() }}
        </div>
        
    @else

        <p class="text-center text-gray-600 text-sm font-bold">No hay publicaciones aún</p>
        
    @endif
</div>