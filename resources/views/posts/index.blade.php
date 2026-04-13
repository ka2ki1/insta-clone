<h1>投稿一覧</h1>

<a href="{{ route('posts.create') }}">新規投稿</a>

@foreach ($posts as $post)
<div style="margin-bottom: 20px; border: 1px solid #ccc; padding: 10px;">
    <strong>{{ $post->user->name }}</strong>
    <p>{{ $post->body }}</p>

    @if ($post->image_path)
    <img src="{{ asset('storage/' . $post->image_path) }}" width="200">
    @endif

    {{-- ここからいいね機能 --}}
    <p>いいね数: {{ $post->likes->count() }}</p>

    @php
    $liked = $post->likes->contains('user_id', auth()->id());
    @endphp

    @if ($liked)
    <form action="{{ route('likes.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">いいね解除</button>
    </form>
    @else
    <form action="{{ route('likes.store', $post) }}" method="POST">
        @csrf
        <button type="submit">いいね</button>
    </form>
    @endif
    {{-- ここまでいいね機能 --}}

    @if ($post->user_id === auth()->id())
    <form action="{{ route('posts.destroy', $post) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit">削除</button>
    </form>
    @endif

</div>
@endforeach
