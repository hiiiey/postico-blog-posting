<x-app-layout>
    <div class="bg-white min-h-screen">
        <!-- Hero Section -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="border-b pb-8">
                <h1 class="text-3xl font-bold mb-2">Medium</h1>
                <div class="flex items-center space-x-6 overflow-x-auto py-2 scrollbar-hide">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-900 font-medium whitespace-nowrap {{ !request('category') ? 'bg-gray-100 px-4 py-2 rounded-full' : '' }}">For
                        you</a>
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-500 font-medium whitespace-nowrap hover:text-gray-900">Following</a>
                    @foreach ($categories as $category)
                    <a href="{{ route('post.byCategory', $category) }}"
                        class="text-gray-500 font-medium whitespace-nowrap hover:text-gray-900 {{ request('category') && request('category')->id == $category->id ? 'bg-gray-100 px-4 py-2 rounded-full' : '' }}">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Posts Column -->
                <div class="lg:col-span-2">
                    <div class="space-y-8">
                        @forelse ($featuredPosts as $post)
                        <div class="border-b pb-8">
                            <div class="flex items-center mb-2">
                                <a href="{{ route('profile.show', $post->user->username) }}">
                                    <x-user-avatar :user="$post->user" size="w-6 h-6" />
                                </a>
                                <a href="{{ route('profile.show', $post->user->username) }}"
                                    class="text-sm font-medium hover:underline">
                                    {{ $post->user->name }}
                                </a>
                            </div>
                            <div class="flex flex-col md:flex-row md:items-start gap-4">
                                <div class="flex-1">
                                    <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                        class="group">
                                        <h2 class="text-xl font-bold mb-2 group-hover:text-gray-700">{{ $post->title
                                            }}</h2>
                                        <p class="text-gray-700 line-clamp-2 mb-2">{{
                                            Str::limit(strip_tags($post->content), 150) }}</p>
                                    </a>
                                    <div class="flex items-center text-xs text-gray-500">
                                        <span>{{ $post->created_at->format('M d, Y') }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500 mt-2">
                                        <span class="flex items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            {{ $post->claps_count }}
                                        </span>
                                    </div>
                                </div>
                                @if($post->image)
                                <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                    class="block">
                                    <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                                        class="w-full md:w-32 h-32 object-cover">
                                </a>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-8 text-gray-500">No posts available</div>
                        @endforelse
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="hidden lg:block">
                    <div class="sticky top-24">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-4">Staff Picks</h3>
                            <div class="space-y-4">
                                @forelse ($staffPicks as $post)
                                <div>
                                    <div class="flex items-center mb-2">
                                        <a href="{{ route('profile.show', $post->user->username) }}">
                                            <x-user-avatar :user="$post->user" size="w-5 h-5" />
                                        </a>
                                        <a href="{{ route('profile.show', $post->user->username) }}"
                                            class="text-sm hover:underline">
                                            {{ $post->user->name }}
                                        </a>
                                    </div>
                                    <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                                        class="text-base font-medium hover:underline">
                                        {{ $post->title }}
                                    </a>
                                </div>
                                @empty
                                <div class="text-gray-500">No staff picks available</div>
                                @endforelse
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-4">Recommended topics</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach ($categories as $category)
                                <a href="{{ route('post.byCategory', $category) }}"
                                    class="bg-gray-100 px-4 py-2 rounded-full text-sm hover:bg-gray-200">
                                    {{ $category->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>

                        @guest
                        <div class="border-t pt-8">
                            <div class="mb-4">
                                <a href="{{ route('login') }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-black text-white rounded-full font-medium hover:bg-gray-800 w-full">
                                    Sign In
                                </a>
                            </div>
                            <div>
                                <a href="{{ route('register') }}"
                                    class="inline-flex justify-center items-center px-4 py-2 bg-white border border-black text-black rounded-full font-medium hover:bg-gray-50 w-full">
                                    Create account
                                </a>
                            </div>
                        </div>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>