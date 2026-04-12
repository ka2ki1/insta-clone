<h1>投稿作成</h1>

<form action="{{ route('posts.store') }}" method="POST">
    @csrf

    <div>
        <textarea name="body" rows="5" cols="40" placeholder="本文を入力">{{ old('body') }}</textarea>
    </div>

    @error('body')
    <p>{{ $message }}</p>
    @enderror

    <button type="submit">投稿する</button>
</form>
