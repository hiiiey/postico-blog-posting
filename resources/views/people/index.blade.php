<x-app-layout>
    <div class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8">
                    <h1 class="text-3xl font-bold mb-6 text-gray-800 border-b pb-3">People You May Know</h1>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($users as $user)
                        <div
                            class="border border-gray-200 rounded-xl p-6 flex flex-col items-center hover:shadow-md transition duration-300 ease-in-out transform hover:-translate-y-1">
                            <div
                                class="w-24 h-24 rounded-full overflow-hidden mb-4 shadow-md border-2 border-indigo-100">
                                @if($user->imageUrl())
                                <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
                                    class="w-full h-full object-cover">
                                @else
                                <div
                                    class="w-full h-full bg-indigo-100 flex items-center justify-center text-indigo-500 text-2xl font-bold">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                @endif
                            </div>

                            <h3 class="font-semibold text-xl text-gray-800">{{ $user->name }}</h3>
                            <p class="text-sm text-indigo-600 mb-3 font-medium">{{ '@' . $user->username }}</p>

                            @if($user->bio)
                            <p class="text-sm text-center text-gray-600 mb-5 line-clamp-3">{{ Str::limit($user->bio,
                                120) }}</p>
                            @else
                            <p class="text-sm text-center text-gray-400 italic mb-5">No bio available</p>
                            @endif

                            <div class="flex mt-auto space-x-3 w-full justify-center">
                                <a href="{{ route('profile.show', $user->username) }}"
                                    class="px-4 py-2 rounded-md border border-indigo-300 text-indigo-600 hover:bg-indigo-50 transition duration-200 text-sm font-medium">
                                    View Profile
                                </a>

                                <button
                                    class="follow-button px-4 py-2 rounded-md text-sm font-medium transition duration-200 {{ $user->isFollowedBy(auth()->user()) ? 'bg-gray-100 hover:bg-gray-200 text-gray-700 border border-gray-300' : 'bg-indigo-600 text-white hover:bg-indigo-700' }}"
                                    data-user-id="{{ $user->id }}" onclick="followUser({{ $user->id }}, this)">
                                    {{ $user->isFollowedBy(auth()->user()) ? 'Unfollow' : 'Follow' }}
                                </button>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-full p-10 text-center">
                            <svg class="w-16 h-16 mx-auto text-gray-300 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            <p class="text-lg text-gray-500">No other users found at the moment.</p>
                        </div>
                        @endforelse
                    </div>

                    @if(count($users) > 9)
                    <div class="mt-8 flex justify-center">
                        {{ $users->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <script>
        function followUser(userId, button) {
            button.disabled = true;
            button.classList.add('opacity-75');
            
            fetch(`/follow/${userId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                }
            })
            .then(response => response.json())
            .then(data => {
                if (button.innerText === 'Follow') {
                    button.innerText = 'Unfollow';
                    button.classList.remove('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                    button.classList.add('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700', 'border', 'border-gray-300');
                } else {
                    button.innerText = 'Follow';
                    button.classList.remove('bg-gray-100', 'hover:bg-gray-200', 'text-gray-700', 'border', 'border-gray-300');
                    button.classList.add('bg-indigo-600', 'text-white', 'hover:bg-indigo-700');
                }
                button.disabled = false;
                button.classList.remove('opacity-75');
            })
            .catch(error => {
                console.error('Error:', error);
                button.disabled = false;
                button.classList.remove('opacity-75');
            });
        }
    </script>
</x-app-layout>