<x-app-layout>
    <div class="max-w-md mx-auto py-8 px-4">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-xl font-bold">投稿一覧</h1>

            <a href="{{ route('posts.create') }}"
               class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                新規投稿
            </a>
        </div>

        <div class="space-y-6">
            @foreach ($posts as $post)
                <div class="bg-white shadow rounded-2xl border">

                    {{-- ユーザー名 --}}
                    <div class="px-4 py-3 border-b">
                        <p class="font-semibold text-gray-800">
                            {{ $post->user->name }}
                        </p>
                    </div>

                    {{-- 画像 --}}
                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                             class="w-full h-80 object-cover">
                    @endif

                    {{-- 本文 --}}
                    <div class="px-4 py-3">
                        <p class="text-gray-800 mb-3">
                            {{ $post->body }}
                        </p>

                        {{-- いいね --}}
                        <div class="flex items-center gap-3 mb-3">
                            <p class="text-sm text-gray-600">
                                いいね {{ $post->likes->count() }}
                            </p>

                            @php
                                $liked = $post->likes->contains('user_id', auth()->id());
                            @endphp

                            @if ($liked)
                                <form action="{{ route('likes.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-sm text-red-500">いいね解除</button>
                                </form>
                            @else
                                <form action="{{ route('likes.store', $post) }}" method="POST">
                                    @csrf
                                    <button class="text-sm text-pink-500">いいね</button>
                                </form>
                            @endif
                        </div>

                        {{-- コメント --}}
                        <div class="mb-3">
                            @foreach ($post->comments as $comment)
                                <div class="text-sm mb-1">
                                    <span class="font-semibold">
                                        {{ $comment->user->name }}
                                    </span>
                                    <span>
                                        {{ $comment->body }}
                                    </span>
                                </div>
                            @endforeach
                        </div>

                        {{-- コメント投稿 --}}
                        <form action="{{ route('comments.store', $post) }}" method="POST" class="flex gap-2">
                            @csrf
                            <input type="text"
                                   name="body"
                                   placeholder="コメントを書く"
                                   class="flex-1 border rounded px-2 py-1 text-sm">
                            <button class="text-blue-500 text-sm">
                                投稿
                            </button>
                        </form>

                        {{-- 削除 --}}
                        @if ($post->user_id === auth()->id())
                            <div class="mt-3">
                                <form action="{{ route('posts.destroy', $post) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="text-gray-500 text-sm">
                                        削除
                                    </button>
                                </form>
                            </div>
                        @endif
                    </div>

                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
