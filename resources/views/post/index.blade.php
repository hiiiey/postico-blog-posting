<x-app-layout>
    <div class="bg-white min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="border-b pb-8">
                @if(isset($searchQuery))
                <div class="mb-4">
                    <h1 class="text-2xl font-bold text-gray-900">Search results for: "{{ $searchQuery }}"</h1>
                    <p class="text-gray-500">{{ $posts->total() }} {{ Str::plural('result', $posts->total()) }} found
                    </p>
                </div>
                @else
                <div class="flex items-center space-x-6 overflow-x-auto py-2 scrollbar-hide">
                    <a href="{{ route('dashboard') }}"
                        class="text-gray-500 font-medium whitespace-nowrap hover:text-gray-900 {{ !request('category') ? 'bg-gray-100 px-4 py-2 rounded-full text-gray-900' : '' }}">
                        For you
                    </a>
                    @foreach (\App\Models\Category::all() as $category)
                    <a href="{{ route('post.byCategory', $category) }}"
                        class="text-gray-500 font-medium whitespace-nowrap hover:text-gray-900 {{ request('category') && request('category')->id == $category->id ? 'bg-gray-100 px-4 py-2 rounded-full text-gray-900' : '' }}">
                        {{ $category->name }}
                    </a>
                    @endforeach
                </div>
                @endif
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <div class="lg:col-span-2">
                    <div>
                        @forelse ($posts as $post)
                        <x-post-item :post="$post"></x-post-item>
                        @empty
                        <div class="text-center text-gray-500 py-16">No Posts Found</div>
                        @endforelse
                    </div>

                    <div class="mt-4">
                        {{ $posts->links() }}
                    </div>
                </div>

                <div class="hidden lg:block">
                    <div class="sticky top-24">
                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-4">People you might be interested in</h3>
                            <div class="space-y-4">
                                @php
                                $currentUser = auth()->user();
                                $followingIds = $currentUser ? $currentUser->following()->pluck('users.id')->toArray() :
                                [];

                                $suggestedUsers = \App\Models\User::whereNotIn('id', array_merge([$currentUser->id],
                                $followingIds))
                                ->inRandomOrder()
                                ->take(3)
                                ->get();
                                @endphp

                                @if($suggestedUsers->isEmpty())
                                <p class="text-gray-500 text-sm">No new people to follow at the moment.</p>
                                @else
                                @foreach ($suggestedUsers as $user)
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <a href="{{ route('profile.show', $user->username) }}">
                                            <x-user-avatar :user="$user" size="w-8 h-8" class="mr-3" />
                                        </a>
                                        <div>
                                            <a href="{{ route('profile.show', $user->username) }}"
                                                class="font-medium hover:underline">{{ $user->name }}</a>
                                            <div class="text-sm text-gray-500">{{ '@' . $user->username }}</div>
                                        </div>
                                    </div>
                                    <x-follow-ctr :user="$user">
                                        @if(auth()->id() !== $user->id)
                                        <button x-text="following ? 'Following' : 'Follow'"
                                            :class="following ? 'text-gray-600' : 'text-medium-green'"
                                            class="text-sm font-medium hover:text-green-800" @click="follow()">
                                        </button>
                                        @endif
                                    </x-follow-ctr>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>

                        <div class="mb-8">
                            <h3 class="text-lg font-bold mb-4">Recommended topics</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach (\App\Models\Category::all() as $category)
                                <a href="{{ route('post.byCategory', $category) }}"
                                    class="bg-gray-100 px-4 py-2 rounded-full text-sm hover:bg-gray-200">
                                    {{ $category->name }}
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>