<?php

namespace App\Http\Controllers;

use App\Models\Post;

class MypageController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        $posts = Post::with(['user', 'likes', 'comments.user'])
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        return view('mypage.index', compact('user', 'posts'));
    }
}
