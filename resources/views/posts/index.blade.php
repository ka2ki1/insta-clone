<x-app-layout>
    <div style="max-width: 460px; margin: 32px auto; padding: 0 12px;">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px;">
            <h1 style="font-size: 22px; font-weight: bold;">投稿一覧</h1>

            <div>
                <a href="{{ route('mypage.index') }}"
                   style="display: inline-block; background: #374151; color: white; padding: 8px 14px; border-radius: 8px; text-decoration: none; margin-right: 8px;">
                    マイページ
                </a>

                <a href="{{ route('posts.create') }}"
                   style="display: inline-block; background: #3b82f6; color: white; padding: 8px 14px; border-radius: 8px; text-decoration: none;">
                    新規投稿
                </a>
            </div>
        </div>

        @foreach ($posts as $post)
            <div style="max-width: 420px; margin: 0 auto 24px; background: white; border: 1px solid #ddd; border-radius: 12px; overflow: hidden;">
                <div style="padding: 12px 16px; border-bottom: 1px solid #eee;">
                    <strong>{{ $post->user->name }}</strong>
                </div>

                @if ($post->image_path)
                    <div style="width: 100%; height: 320px; overflow: hidden; background: #f3f4f6;">
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                             style="width: 100%; height: 100%; object-fit: cover; display: block;">
                    </div>
                @endif

                <div style="padding: 14px 16px;">
                    <p style="margin-bottom: 12px;">{{ $post->body }}</p>

                    <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 12px;">
                        <span style="font-size: 14px;">いいね {{ $post->likes->count() }}</span>

                        @php
                            $liked = $post->likes->contains('user_id', auth()->id());
                        @endphp

                        @if ($liked)
                            <form action="{{ route('likes.destroy', $post) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="color: #ef4444; background: none; border: none; cursor: pointer;">
                                    いいね解除
                                </button>
                            </form>
                        @else
                            <form action="{{ route('likes.store', $post) }}" method="POST">
                                @csrf
                                <button type="submit" style="color: #ec4899; background: none; border: none; cursor: pointer;">
                                    いいね
                                </button>
                            </form>
                        @endif
                    </div>

                    <div style="margin-bottom: 12px;">
                        @foreach ($post->comments as $comment)
                            <div style="font-size: 14px; margin-bottom: 4px;">
                                <strong>{{ $comment->user->name }}</strong>
                                <span>{{ $comment->body }}</span>
                            </div>
                        @endforeach
                    </div>

                    <form action="{{ route('comments.store', $post) }}" method="POST" style="display: flex; gap: 8px; margin-bottom: 12px;">
                        @csrf
                        <input type="text"
                               name="body"
                               placeholder="コメントを書く"
                               style="flex: 1; padding: 6px 8px; border: 1px solid #ccc; border-radius: 6px;">
                        <button type="submit" style="color: #2563eb; background: none; border: none; cursor: pointer;">
                            投稿
                        </button>
                    </form>

                    @if ($post->user_id === auth()->id())
                        <form action="{{ route('posts.destroy', $post) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="color: #6b7280; background: none; border: none; cursor: pointer;">
                                削除
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>
