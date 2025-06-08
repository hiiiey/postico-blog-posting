<div class="border border-gray-100 rounded-xl hover:shadow-md transition-all duration-300 overflow-hidden">
    <div class="p-6">
        <!-- Author info -->
        <div class="flex items-center mb-4">
            <a href="{{ route('profile.show', $post->user->username) }}"
                class="flex items-center hover:opacity-80 transition-opacity">
                <x-user-avatar :user="$post->user" size="w-8 h-8" class="mr-3 border border-gray-100" />
                <div>
                    <p class="text-sm font-medium text-gray-900">{{ $post->user->name }}</p>
                    <p class="text-xs text-gray-500">{{ $post->created_at->format('M d, Y') }}</p>
                </div>
            </a>
        </div>

        <!-- Post content -->
        <div class="flex flex-col md:flex-row gap-6">
            <div class="flex-1">
                <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                    class="group">
                    <h2 class="text-xl font-bold mb-3 group-hover:text-indigo-600 transition-colors">{{ $post->title }}
                    </h2>
                    <p class="text-gray-700 line-clamp-2 mb-4">{{ Str::limit(strip_tags($post->content), 150) }}</p>
                </a>

                <!-- Post metadata -->
                <div class="flex items-center text-xs text-gray-500 mt-4">
                    @if($post->category)
                    <span class="bg-indigo-50 text-indigo-600 px-3 py-1 rounded-full text-xs font-medium">{{
                        $post->category->name }}</span>
                    <span class="mx-2">·</span>
                    @endif

                    <span class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905a3.61 3.61 0 01-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                        </svg>
                        <span>{{ $post->claps()->count() }}</span>
                    </span>

                    <span class="mx-2">·</span>
                    <span class="text-xs">{{ $post->created_at->diffForHumans() }}</span>
                </div>
            </div>

            @if($post->image)
            <a href="{{ route('post.show', ['username' => $post->user->username, 'post' => $post->slug]) }}"
                class="block shrink-0">
                <img src="{{ $post->imageUrl() }}" alt="{{ $post->title }}"
                    class="w-full md:w-40 h-32 object-cover rounded-lg">
            </a>
            @endif
        </div>
    </div>
</div>