<form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div>
        <textarea name="body"></textarea>
    </div>

    <div>
        <input type="file" name="image">
    </div>

    <button type="submit">投稿する</button>
</form>
