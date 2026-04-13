<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $post->likes()->firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('posts.index');
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return redirect()->route('posts.index');
    }
}
