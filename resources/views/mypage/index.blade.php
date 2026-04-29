<x-app-layout>
    <div class="max-w-md mx-auto py-8 px-4">
        <div class="bg-white shadow rounded-2xl p-6 border mb-6">
            <h1 class="text-2xl font-bold mb-2">{{ $user->name }}</h1>
            <p class="text-gray-600">{{ $user->email }}</p>
        </div>

        <h2 class="text-xl font-bold mb-4">自分の投稿</h2>

        <div class="space-y-6">
            @forelse ($posts as $post)
                <div class="bg-white shadow rounded-2xl border">
                    <div class="px-4 py-3 border-b">
                        <p class="font-semibold text-gray-800">{{ $post->user->name }}</p>
                    </div>

                    @if ($post->image_path)
                        <img src="{{ asset('storage/' . $post->image_path) }}"
                             class="w-full h-80 object-cover">
                    @endif

                    <div class="px-4 py-3">
                        <p class="text-gray-800 mb-3">{{ $post->body }}</p>

                        <p class="text-sm text-gray-600 mb-3">
                            いいね {{ $post->likes->count() }}
                        </p>

                        <div class="mb-3">
                            @foreach ($post->comments as $comment)
                                <div class="text-sm mb-1">
                                    <span class="font-semibold">
                                        {{ $comment->user->name }}
                                    </span>
                                    <span>{{ $comment->body }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">まだ投稿がありません。</p>
            @endforelse
        </div>
    </div>
</x-app-layout>
