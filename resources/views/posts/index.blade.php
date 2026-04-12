<h1>投稿一覧</h1>

<a href="{{ route('posts.create') }}">新規投稿</a>

@foreach ($posts as $post)
<div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
    <strong>{{ $post->user->name }}</strong>
    <p>{{ $post->body }}</p>

    @if ($post->user_id === auth()->id())
    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
    @endif
</div>
@endforeach
