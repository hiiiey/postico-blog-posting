<x-app-layout>
    <div class="bg-gradient-to-b from-indigo-50 to-white py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">

                <div class="h-48 bg-gradient-to-r from-indigo-500 to-purple-600 relative">

                    <div class="absolute -bottom-16 left-8">
                        <div class="rounded-full border-4 border-white shadow-md bg-white">
                            <x-user-avatar :user="$user" size="w-32 h-32" />
                        </div>
                    </div>
                </div>


                <div class="pt-20 px-8 pb-8">
                    <div class="flex flex-col md:flex-row md:items-center md:justify-between">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900">{{ $user->name }}</h1>
                            <p class="text-gray-600 font-medium">{{ '@' . $user->username }}</p>
                        </div>

                        <x-follow-ctr :user="$user" class="mt-4 md:mt-0">
                            <div class="flex items-center space-x-4">
                                <div class="text-center">
                                    <p class="text-gray-700 font-medium text-sm">Followers</p>
                                    <p class="text-xl font-bold text-gray-900" x-text="followersCount"></p>
                                </div>

                                @if (auth()->user() && auth()->user()->id !== $user->id)
                                <button @click="follow()"
                                    class="rounded-full px-6 py-2 font-medium text-sm transition-all duration-200"
                                    x-text="following ? 'Unfollow' : 'Follow'"
                                    :class="following ? 'bg-gray-200 text-gray-800 hover:bg-gray-300' : 'bg-indigo-600 text-white hover:bg-indigo-700'">
                                </button>
                                @endif
                            </div>
                        </x-follow-ctr>
                    </div>

                    @if ($user->bio)
                    <div class="mt-6 bg-gray-50 p-4 rounded-lg border border-gray-100">
                        <h3 class="text-sm font-medium text-gray-700 mb-2">About</h3>
                        <p class="text-gray-800">{{ $user->bio }}</p>
                    </div>
                    @endif
                </div>
            </div>


            <div class="mt-8">
                <div class="bg-white shadow-sm sm:rounded-lg p-6">
                    <div class="flex items-center justify-between mb-6 border-b pb-4">
                        <h2 class="text-2xl font-bold text-gray-800">Posts</h2>

                        <div class="flex space-x-6">
                            <div class="text-center">
                                <p class="text-xs text-gray-500">Posts</p>
                                <p class="font-bold">{{ $posts->count() }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8">
                        @forelse ($posts as $p)
                        <x-post-item :post="$p"></x-post-item>
                        @empty
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h7M9 15h2M9 18h6">
                                </path>
                            </svg>
                            <h3 class="text-xl font-medium text-gray-600">No Posts Yet</h3>
                            <p class="text-gray-500 mt-2">This user hasn't published any posts.</p>
                        </div>
                        @endforelse
                    </div>

                    @if ($posts->hasPages())
                    <div class="mt-8 pt-4 border-t">
                        {{ $posts->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>