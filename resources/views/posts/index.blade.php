<h1 style="margin-bottom: 20px;">投稿一覧</h1>

<a href="{{ route('posts.create') }}" style="display: inline-block; margin-bottom: 20px;">
    新規投稿
</a>

@foreach ($posts as $post)
<div style="margin-bottom: 24px; border: 1px solid #ccc; padding: 16px; border-radius: 8px; max-width: 500px;">
    <div style="margin-bottom: 10px;">
        <strong>{{ $post->user->name }}</strong>
    </div>

    <p style="margin-bottom: 12px;">{{ $post->body }}</p>

    @if ($post->image_path)
        <div style="margin-bottom: 12px;">
            <img src="{{ asset('storage/' . $post->image_path) }}" width="300" style="border-radius: 8px;">
        </div>
    @endif

    <div style="margin-bottom: 12px;">
        <p>いいね数: {{ $post->likes->count() }}</p>

        @php
            $liked = $post->likes->contains('user_id', auth()->id());
        @endphp

        @if ($liked)
            <form action="{{ route('likes.destroy', $post) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit">いいね解除</button>
            </form>
        @else
            <form action="{{ route('likes.store', $post) }}" method="POST" style="display: inline-block;">
                @csrf
                <button type="submit">いいね</button>
            </form>
        @endif
    </div>

    <div style="margin-bottom: 12px;">
        <p><strong>コメント</strong></p>

        @foreach ($post->comments as $comment)
            <div style="margin-left: 12px; margin-bottom: 6px;">
                <strong>{{ $comment->user->name }}</strong>
                <span>{{ $comment->body }}</span>
            </div>
        @endforeach

        <form action="{{ route('comments.store', $post) }}" method="POST" style="margin-top: 10px;">
            @csrf
            <input type="text" name="body" placeholder="コメントを書く">
            <button type="submit">コメントする</button>
        </form>
    </div>

    @if ($post->user_id === auth()->id())
        <form action="{{ route('posts.destroy', $post) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">削除</button>
        </form>
    @endif
</div>
@endforeach
