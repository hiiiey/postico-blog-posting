<x-app-layout>
    <div class="min-h-screen bg-white text-gray-900 overflow-hidden">

        <div class="fixed inset-0 overflow-hidden pointer-events-none">
            <div
                class="absolute -top-40 -right-40 w-80 h-80 bg-gray-100 rounded-full mix-blend-multiply filter blur-xl opacity-10">
            </div>
            <div
                class="absolute -bottom-40 -left-40 w-80 h-80 bg-gray-200 rounded-full mix-blend-multiply filter blur-xl opacity-10">
            </div>
        </div>

        <section class="relative px-6 py-20 md:py-32">
            <div class="max-w-7xl mx-auto text-center">
                <div class="transform transition-all duration-1000 opacity-100 translate-y-0">
                    <h1 class="text-5xl md:text-7xl font-bold mb-6 text-gray-900">
                        Where Stories
                        <br />
                        <span
                            class="inline-block bg-gradient-to-r from-gray-600 via-gray-800 to-gray-600 bg-clip-text text-transparent bg-[length:200%_100%] animate-gradient">
                            Come Alive
                        </span>
                    </h1>
                </div>

                <p
                    class="text-xl md:text-2xl text-gray-600 mb-12 max-w-3xl mx-auto leading-relaxed transform transition-all duration-800 delay-300 opacity-100 translate-y-0">
                    Discover compelling stories across politics, entertainment, health, technology, sports, and science.
                    Your
                    gateway to the world's most engaging content.
                </p>

                <div
                    class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-16 transform transition-all duration-800 delay-600 opacity-100 translate-y-0">
                    <a href="{{ route('login') }}"
                        class="inline-flex items-center justify-center rounded-md font-medium ring-offset-background transition-colors focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:pointer-events-none disabled:opacity-50 bg-gray-900 hover:bg-gray-800 text-white border-0 px-8 py-6 text-lg group">
                        Start Reading
                        <span class="ml-2 group-hover:translate-x-1 transition-transform">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="w-5 h-5">
                                <path d="M5 12h14"></path>
                                <path d="m12 5 7 7-7 7"></path>
                            </svg>
                        </span>
                    </a>
                </div>

                <div class="animate-bounce opacity-100 delay-1200">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="w-8 h-8 mx-auto text-gray-500">
                        <path d="m6 9 6 6 6-6"></path>
                    </svg>
                </div>
            </div>
        </section>

        <section class="relative px-6 py-20 bg-gray-50 bg-gradient-to-b from-transparent to-black/20">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 transform transition-all duration-800 opacity-100 translate-y-0">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Explore Our Universe</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Dive into diverse topics that shape our world</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                    $categoryIcons = [
                    'Politics' => ['icon' => 'users', 'color' => 'from-red-500 to-pink-500'],
                    'Entertainment' => ['icon' => 'star', 'color' => 'from-purple-500 to-indigo-500'],
                    'Health' => ['icon' => 'heart', 'color' => 'from-green-500 to-emerald-500'],
                    'Technology' => ['icon' => 'cpu', 'color' => 'from-blue-500 to-cyan-500'],
                    'Sports' => ['icon' => 'trophy', 'color' => 'from-orange-500 to-yellow-500'],
                    'Science' => ['icon' => 'microscope', 'color' => 'from-teal-500 to-green-500'],
                    ];

                    $categoryDescriptions = [
                    'Politics' => 'Breaking political news and analysis',
                    'Entertainment' => 'Latest celebrity news and reviews',
                    'Health' => 'Wellness tips and medical breakthroughs',
                    'Technology' => 'Tech innovations and digital trends',
                    'Sports' => 'Sports news and live coverage',
                    'Science' => 'Scientific discoveries and research',
                    ];
                    @endphp

                    @foreach ($categories as $index => $category)
                    @php
                    $iconData = $categoryIcons[$category->name] ?? ['icon' => 'file-text', 'color' => 'from-gray-500
                    to-gray-700'];
                    $description = $categoryDescriptions[$category->name] ?? 'Interesting articles and stories';
                    $postCount = $category->posts_count ?? rand(100, 300);
                    @endphp
                    <div
                        class="group cursor-pointer transform transition-all duration-600 hover:-translate-y-2 hover:scale-102">
                        <div
                            class="bg-white border border-gray-200 hover:border-gray-300 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden rounded-lg">
                            <div class="p-6">
                                <div
                                    class="w-12 h-12 rounded-lg bg-gradient-to-r {{ $iconData['color'] }} flex items-center justify-center mb-4 group-hover:scale-110 transition-transform duration-300">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round" class="w-6 h-6 text-white">
                                        @switch($iconData['icon'])
                                        @case('users')
                                        <path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path>
                                        <circle cx="9" cy="7" r="4"></circle>
                                        <path d="M22 21v-2a4 4 0 0 0-3-3.87"></path>
                                        <path d="M16 3.13a4 4 0 0 1 0 7.75"></path>
                                        @break
                                        @case('star')
                                        <polygon
                                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                        </polygon>
                                        @break
                                        @case('heart')
                                        <path
                                            d="M19 14c1.49-1.46 3-3.21 3-5.5A5.5 5.5 0 0 0 16.5 3c-1.76 0-3 .5-4.5 2-1.5-1.5-2.74-2-4.5-2A5.5 5.5 0 0 0 2 8.5c0 2.3 1.5 4.05 3 5.5l7 7Z">
                                        </path>
                                        @break
                                        @case('cpu')
                                        <rect x="4" y="4" width="16" height="16" rx="2"></rect>
                                        <rect x="9" y="9" width="6" height="6"></rect>
                                        <path d="M15 2v2"></path>
                                        <path d="M15 20v2"></path>
                                        <path d="M2 15h2"></path>
                                        <path d="M2 9h2"></path>
                                        <path d="M20 15h2"></path>
                                        <path d="M20 9h2"></path>
                                        <path d="M9 2v2"></path>
                                        <path d="M9 20v2"></path>
                                        @break
                                        @case('trophy')
                                        <path d="M6 9H4.5a2.5 2.5 0 0 1 0-5H6"></path>
                                        <path d="M18 9h1.5a2.5 2.5 0 0 0 0-5H18"></path>
                                        <path d="M4 22h16"></path>
                                        <path d="M10 14.66V17c0 .55-.47.98-.97 1.21C7.85 18.75 7 20.24 7 22"></path>
                                        <path d="M14 14.66V17c0 .55.47.98.97 1.21C16.15 18.75 17 20.24 17 22"></path>
                                        <path d="M18 2H6v7a6 6 0 0 0 12 0V2Z"></path>
                                        @break
                                        @case('microscope')
                                        <path d="M6 18h8"></path>
                                        <path d="M3 22h18"></path>
                                        <path d="M14 22a7 7 0 1 0 0-14h-1"></path>
                                        <path d="M9 14h2"></path>
                                        <path d="M9 12a2 2 0 0 1-2-2V6h6v4a2 2 0 0 1-2 2Z"></path>
                                        <path d="M12 6V3a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v3"></path>
                                        @break
                                        @default
                                        <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z">
                                        </path>
                                        <polyline points="14 2 14 8 20 8"></polyline>
                                        @endswitch
                                    </svg>
                                </div>
                                <h3
                                    class="text-xl font-semibold mb-2 text-gray-900 group-hover:text-gray-700 transition-all duration-300">
                                    {{ $category->name }}
                                </h3>
                                <p class="text-gray-600 mb-4 group-hover:text-gray-500 transition-colors">
                                    {{ $description }}
                                </p>
                                <div class="flex items-center justify-between">
                                    <div
                                        class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors bg-gray-100 text-gray-700 border-0">
                                        {{ $postCount }} posts
                                    </div>
                                    <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 text-gray-600 group-hover:translate-x-1 transition-transform">
                                            <path d="M5 12h14"></path>
                                            <path d="m12 5 7 7-7 7"></path>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </section>

        <section class="relative px-6 py-20">
            <div class="max-w-7xl mx-auto">
                <div class="text-center mb-16 transform transition-all duration-800 opacity-100 translate-y-0">
                    <h2 class="text-4xl md:text-5xl font-bold mb-4 text-gray-900">Featured Stories</h2>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">Hand-picked articles that are making waves</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @php
                    $addDummyPost = count($featuredPosts) < 3; @endphp @forelse ($featuredPosts as $index=> $post)
                        @php
                        $readTime = rand(3, 15) . ' min read';
                        $views = rand(1, 20) . '.' . rand(1, 9) . 'K';
                        $categoryName = 'Uncategorized';

                        if ($post->categories && $post->categories->count() > 0) {
                        $categoryName = $post->categories->first()->name;
                        } elseif (isset($post->category) && $post->category) {
                        $categoryName = $post->category->name;
                        }
                        @endphp
                        <div class="group cursor-pointer transform transition-all duration-600 hover:-translate-y-1">
                            <div
                                class="bg-white border border-gray-200 hover:border-gray-300 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden rounded-lg">
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post->imageUrl() ?? '/images/placeholder.jpg' }}"
                                        alt="{{ $post->title }}"
                                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-4 left-4">
                                        <div
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors bg-gray-900 text-white border-0">
                                            {{ $categoryName }}
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-semibold mb-3 text-gray-900 group-hover:text-gray-700 transition-all duration-300 line-clamp-2">
                                        {{ $post->title }}
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        {{ Str::limit(strip_tags($post->content), 150) }}
                                    </p>
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <span>{{ $readTime }}</span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <span>{{ $views }}</span>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 text-green-400">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <div class="col-span-3 text-center py-8 text-gray-500">No posts available</div>
                        @endforelse

                        @if($addDummyPost)

                        <div class="group cursor-pointer transform transition-all duration-600 hover:-translate-y-1">
                            <div
                                class="bg-white border border-gray-200 hover:border-gray-300 shadow-sm hover:shadow-md transition-all duration-300 overflow-hidden rounded-lg">
                                <div class="relative overflow-hidden">
                                    <img src="/images/placeholder.jpg" alt="Exploring the Future of Digital Content"
                                        class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-4 left-4">
                                        <div
                                            class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-semibold transition-colors bg-gray-900 text-white border-0">
                                            Technology
                                        </div>
                                    </div>
                                </div>
                                <div class="p-6">
                                    <h3
                                        class="text-xl font-semibold mb-3 text-gray-900 group-hover:text-gray-700 transition-all duration-300 line-clamp-2">
                                        Exploring the Future of Digital Content
                                    </h3>
                                    <p class="text-gray-600 mb-4 line-clamp-2">
                                        Digital content creation is evolving rapidly with new tools and platforms
                                        emerging daily. How will this change the way we consume media?
                                    </p>
                                    <div class="flex items-center justify-between text-sm text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <circle cx="12" cy="12" r="10"></circle>
                                                    <polyline points="12 6 12 12 16 14"></polyline>
                                                </svg>
                                                <span>7 min read</span>
                                            </div>
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                    viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                                    class="w-4 h-4">
                                                    <path d="M2 12s3-7 10-7 10 7 10 7-3 7-10 7-10-7-10-7Z"></path>
                                                    <circle cx="12" cy="12" r="3"></circle>
                                                </svg>
                                                <span>14.2K</span>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="w-4 h-4 text-green-400">
                                            <polyline points="23 6 13.5 15.5 8.5 10.5 1 18"></polyline>
                                            <polyline points="17 6 23 6 23 12"></polyline>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                </div>
            </div>
        </section>

        <footer class="relative px-6 py-12 border-t border-gray-200 bg-gray-50">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-4 md:mb-0">
                        <span class="text-xl font-bold text-gray-900">Postico</span>
                    </div>

                    <div class="flex items-center space-x-6 text-gray-600">
                        <a href="#" class="hover:text-gray-900 transition-colors">Privacy</a>
                        <a href="#" class="hover:text-gray-900 transition-colors">Terms</a>
                        <a href="#" class="hover:text-gray-900 transition-colors">Contact</a>
                    </div>
                </div>

                <div class="mt-8 pt-8 border-t border-gray-200 text-center text-gray-500">
                    <p>&copy; 2024 Postico. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    <style>
        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .animate-gradient {
            animation: gradient 3s ease infinite;
        }
    </style>
</x-app-layout>