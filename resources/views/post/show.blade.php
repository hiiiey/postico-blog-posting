<x-app-layout>
    <div class="fixed inset-0 w-full h-screen z-0">
        @if ($post->image)
        <div class="w-full h-full">
            <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}" class="w-full h-full object-cover">
            <div class="absolute inset-0 bg-gradient-to-b from-black/30 to-black/60"></div>
        </div>
        @else
        <div class="w-full h-full bg-gradient-to-b from-gray-900 to-gray-700"></div>
        @endif

        <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3" />
            </svg>
        </div>
    </div>

    <div class="h-screen w-full"></div>

    <div class="relative z-10 bg-white min-h-screen rounded-t-3xl shadow-2xl">
        <div class="pt-12 pb-6 px-4 max-w-4xl mx-auto">
            <a href="{{ route('post.byCategory', $post->category) }}"
                class="inline-block px-4 py-1.5 bg-gray-100 text-gray-700 text-sm font-medium rounded-full hover:bg-gray-200 transition mb-5">
                {{ $post->category->name }}
            </a>

            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 leading-tight">
                {{ $post->title }}
            </h1>
        </div>

        <div class="bg-white border-y border-gray-100 sticky top-0 z-20 px-4 py-3 shadow-sm">
            <div class="max-w-4xl mx-auto flex flex-wrap justify-between items-center gap-4">
                <div class="flex items-center">
                    <x-user-avatar :user="$post->user" size="w-10 h-10" class="border-2 border-white" />
                    <div class="ml-3">
                        <x-follow-ctr :user="$post->user" class="flex gap-2 items-center">
                            <a href="{{ route('profile.show', $post->user) }}"
                                class="font-medium text-gray-900 hover:underline">
                                {{ $post->user->name }}
                            </a>

                            @auth
                            <button x-text="following ? 'Following' : 'Follow'"
                                :class="following ? 'bg-gray-200 text-gray-800' : 'bg-medium-green text-white'"
                                class="ml-2 px-3 py-1 text-xs rounded-full font-medium transition-colors duration-200"
                                @click="follow()">
                            </button>
                            @endauth
                        </x-follow-ctr>
                    </div>
                </div>

                <div class="flex items-center gap-4 text-sm text-gray-500">
                    <span>{{ $post->created_at->format('M d, Y') }}</span>
                </div>
            </div>
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="prose prose-lg max-w-none font-serif">
                {!! nl2br(e($post->content)) !!}
            </div>

            <div
                class="mt-16 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-6 border-t border-gray-200 pt-8">
                @if ($post->user_id === Auth::id())
                <div class="flex gap-4">
                    <a href="{{ route('post.edit', $post->slug) }}"
                        class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-full text-sm font-medium text-gray-900 hover:bg-gray-200 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit Post
                    </a>
                    <form class="inline-block" action="{{ route('post.destroy', $post) }}" method="post">
                        @csrf
                        @method('delete')
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 bg-red-50 border border-transparent rounded-full text-sm font-medium text-red-700 hover:bg-red-100 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                            Delete Post
                        </button>
                    </form>
                </div>
                @endif

                <x-clap-button :post="$post" />
            </div>

            <div class="mt-12 flex items-center gap-4 border-t border-gray-200 pt-8">
                <span class="text-sm font-medium text-gray-500">SHARE THIS POST</span>
                <div class="flex gap-3">
                    <a href="#" class="text-gray-500 hover:text-gray-800 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-facebook" viewBox="0 0 16 16">
                            <path
                                d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-800 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-twitter-x" viewBox="0 0 16 16">
                            <path
                                d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-500 hover:text-gray-800 transition-colors duration-200">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-linkedin" viewBox="0 0 16 16">
                            <path
                                d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854V1.146zm4.943 12.248V6.169H2.542v7.225h2.401zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248-.822 0-1.359.54-1.359 1.248 0 .694.521 1.248 1.327 1.248h.016zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016a5.54 5.54 0 0 1 .016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225h2.4z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        <div class="bg-gray-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold mb-12 text-center">More from {{ $post->category->name }}</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-x-8 gap-y-12">
                    @php
                    $relatedPosts = \App\Models\Post::where('id', '!=', $post->id)
                    ->where('category_id', $post->category_id)
                    ->orderBy('created_at', 'desc')
                    ->take(3)
                    ->get();
                    @endphp

                    @foreach($relatedPosts as $relatedPost)
                    <div
                        class="bg-white rounded-xl shadow-sm overflow-hidden group hover:shadow-md transition-shadow duration-300">
                        <a href="{{ route('post.show', ['username' => $relatedPost->user->username, 'post' => $relatedPost->slug]) }}"
                            class="block">
                            @if ($relatedPost->image)
                            <div class="aspect-[16/9] overflow-hidden">
                                <img src="{{ $relatedPost->imageUrl() }}" alt="{{ $relatedPost->title }}"
                                    class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            </div>
                            @else
                            <div class="aspect-[16/9] bg-gray-100 flex items-center justify-center">
                                <p class="text-gray-400">No image available</p>
                            </div>
                            @endif

                            <div class="p-6">
                                <div class="flex items-center mb-4">
                                    <x-user-avatar :user="$relatedPost->user" size="w-8 h-8"
                                        class="mr-3 border border-gray-100" />
                                    <span class="text-sm font-medium">{{ $relatedPost->user->name }}</span>
                                </div>

                                <h3
                                    class="text-xl font-bold mb-2 group-hover:text-medium-green transition-colors duration-200">
                                    {{ $relatedPost->title }}
                                </h3>

                                <p class="text-gray-600 mb-4 line-clamp-2">
                                    {{ Str::limit(strip_tags($relatedPost->content), 120) }}
                                </p>

                                <div class="flex items-center text-xs text-gray-500">
                                    <span>{{ $relatedPost->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <style>
        .prose {
            font-family: 'Georgia', serif;
            line-height: 1.8;
            color: #374151;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        ::-webkit-scrollbar {
            display: none;
        }

        body {
            -ms-overflow-style: none;

            scrollbar-width: none;
        }
    </style>
</x-app-layout>