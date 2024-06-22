<?php

namespace App\Livewire;

use Livewire\Component;

class LikePost extends Component
{
    public $post;
    public $isLiked;
    public $likes;

    public function mount($post)
    {
        $this->post = $post;
        $this->isLiked = $this->post->likedBy(auth()->user());
        $this->likes = $this->post->likes->count();
    }

    public function like()
    {
        if($this->post->likedBy(auth()->user())) {
            $this->post->likes()->where('post_id', $this->post->id)->delete();
            $this->isLiked = false;
            $this->likes--;
        } else {
            $this->post->likes()->create([
                'user_id' => auth()->user()->id,
            ]);
            $this->isLiked = true;
            $this->likes++;
        }
        
    }

    public function render()
    {
        return view('livewire.like-post');
    }
}
