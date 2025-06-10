<nav x-data="{ open: false, notificationsOpen: false }"
    class="bg-white border-b border-gray-100 fixed top-0 left-0 right-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex items-center">
                    <img src="{{ asset('postico.png') }}" alt="Postico" class="h-10 w-auto">
                </a>
            </div>

            <div class="flex items-center space-x-5">
                <div class="hidden md:flex items-center bg-gray-100 rounded-full px-3 py-1.5">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-500" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input type="text" placeholder="Search"
                        class="bg-transparent border-none outline-none p-1 text-sm w-56">
                </div>

                @auth
                <div class="relative" x-data="notificationSystem()">
                    <button @click="toggleNotifications"
                        class="text-gray-500 hover:text-gray-700 focus:outline-none relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                        </svg>
                        <span x-show="unreadCount > 0" x-text="unreadCount"
                            class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center"></span>
                    </button>

                    <div x-show="notificationsOpen" @click.away="notificationsOpen = false"
                        class="absolute right-0 mt-2 w-80 bg-white rounded-md shadow-lg py-1 z-50"
                        style="display: none;">
                        <div class="px-4 py-2 border-b border-gray-100 flex justify-between items-center">
                            <h3 class="text-sm font-semibold">Notifications</h3>
                            <button @click="markAllAsRead" class="text-xs text-blue-500 hover:text-blue-700">Mark all as
                                read</button>
                        </div>

                        <div x-show="notifications.length === 0" class="px-4 py-2 text-sm text-gray-500">
                            No notifications
                        </div>

                        <template x-for="notification in notifications" :key="notification.id">
                            <div @click="markAsRead(notification.id)"
                                class="px-4 py-3 hover:bg-gray-50 border-b border-gray-100 last:border-0 cursor-pointer"
                                :class="{ 'bg-blue-50': notification.read_at === null }">
                                <div class="flex items-start">
                                    <p class="text-sm" x-show="notification.type.includes('PostLikedNotification')">
                                        <span x-text="notification.data.user_name" class="font-semibold"></span>
                                        liked your post:
                                        <a :href="'/@' + '{{ Auth::user()->username }}/' + notification.data.post_slug"
                                            class="font-medium text-gray-900 hover:underline"
                                            x-text="notification.data.post_title"></a>
                                    </p>
                                    <p class="text-sm" x-show="notification.type.includes('UserFollowedNotification')">
                                        <a :href="'/@' + notification.data.username"
                                            class="font-semibold hover:underline">
                                            <span x-text="notification.data.user_name"></span>
                                        </a>
                                        started following you
                                    </p>
                                </div>
                                <div class="mt-1">
                                    <span class="text-xs text-gray-500"
                                        x-text="formatDate(notification.created_at)"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                <a href="{{ route('post.create') }}" class="hidden md:flex items-center space-x-1 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span class="text-sm">Write</span>
                </a>

                <div class="flex items-center">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="flex items-center text-sm font-medium text-gray-500 hover:text-gray-700 focus:outline-none transition duration-150 ease-in-out">
                                <x-user-avatar :user="Auth::user()" size="h-8 w-8" class="" />
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('myPosts')">
                                {{ __('My Posts') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('people.index')">
                                {{ __('People You May Know') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                @endauth

                @guest
                <a href="{{ route('post.create') }}" class="hidden md:flex items-center space-x-1 text-gray-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    <span>Write</span>
                </a>
                <a href="{{ route('login') }}" class="text-sm font-medium text-gray-500 hover:text-gray-900">Sign In</a>
                <a href="{{ route('register') }}"
                    class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full text-white bg-black hover:bg-gray-800 focus:outline-none">
                    Get started
                </a>
                @endguest

                <div class="flex items-center md:hidden">
                    <button @click="open = !open" class="text-gray-500 hover:text-gray-600 focus:outline-none">
                        <svg x-show="!open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                        <svg x-show="open" class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden md:hidden">
        <div class="pt-2 pb-3 space-y-1">
            @auth
            <x-responsive-nav-link :href="route('profile.edit')">
                {{ __('Profile') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('post.create')">
                {{ __('Write') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('myPosts')">
                {{ __('My Posts') }}
            </x-responsive-nav-link>

            <x-responsive-nav-link :href="route('people.index')">
                {{ __('People You May Know') }}
            </x-responsive-nav-link>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-responsive-nav-link>
            </form>
            @endauth

            @guest
            <x-responsive-nav-link :href="route('login')">
                {{ __('Sign In') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('register')">
                {{ __('Get Started') }}
            </x-responsive-nav-link>
            @endguest
        </div>
    </div>
</nav>

@push('scripts')
<script>
    function notificationSystem() {
        return {
            notifications: [],
            unreadCount: 0,
            notificationsOpen: false,
            
            init() {
                this.fetchNotifications();
                
                setInterval(() => {
                    this.fetchNotifications();
                }, 60000);
            },
            
            fetchNotifications() {
                fetch('{{ route("notifications.index") }}')
                    .then(response => response.json())
                    .then(data => {
                        this.notifications = data.notifications;
                        this.unreadCount = data.unread_count;
                    })
                    .catch(error => console.error('Error fetching notifications:', error));
            },
            
            toggleNotifications() {
                this.notificationsOpen = !this.notificationsOpen;
                if (this.notificationsOpen) {
                    this.fetchNotifications();
                }
            },
            
            markAsRead(id) {
                fetch(`/notifications/${id}/read`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(() => {
                    this.fetchNotifications();
                })
                .catch(error => console.error('Error marking notification as read:', error));
            },
            
            markAllAsRead() {
                fetch('/notifications/read-all', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    }
                })
                .then(response => response.json())
                .then(() => {
                    this.fetchNotifications();
                })
                .catch(error => console.error('Error marking all notifications as read:', error));
            },
            
            formatDate(dateString) {
                const date = new Date(dateString);
                const now = new Date();
                const diffInSeconds = Math.floor((now - date) / 1000);
                
                if (diffInSeconds < 60) {
                    return 'Just now';
                } else if (diffInSeconds < 3600) {
                    const minutes = Math.floor(diffInSeconds / 60);
                    return `${minutes} minute${minutes > 1 ? 's' : ''} ago`;
                } else if (diffInSeconds < 86400) {
                    const hours = Math.floor(diffInSeconds / 3600);
                    return `${hours} hour${hours > 1 ? 's' : ''} ago`;
                } else {
                    const days = Math.floor(diffInSeconds / 86400);
                    return `${days} day${days > 1 ? 's' : ''} ago`;
                }
            }
        }
    }
</script>
@endpush