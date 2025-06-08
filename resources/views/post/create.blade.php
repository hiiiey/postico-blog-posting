<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Create New Post</h1>
                <p class="text-gray-600">Share your thoughts and ideas with the world</p>
            </div>

            <div class="space-y-8">
                <div class="bg-white overflow-hidden shadow-sm rounded-xl border-0 p-6">
                    <div class="pb-6 border-b border-gray-100">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg>
                                <h2 class="text-xl font-bold">Post Details</h2>
                            </div>
                            <div id="wordStats" class="hidden items-center space-x-4 text-sm text-gray-500">
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path
                                            d="M14.5 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V7.5L14.5 2z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                    <span id="wordCount">0 words</span>
                                </div>
                                <div class="flex items-center space-x-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10" />
                                        <polyline points="12 6 12 12 16 14" />
                                    </svg>
                                    <span id="readTime">0 min read</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-6">
                        <form action="{{ route('post.store') }}" enctype="multipart/form-data" method="post">
                            @csrf

                            <div class="space-y-2">
                                <label for="title" class="text-base font-medium">Post Title</label>
                                <input id="title" name="title" value="{{ old('title') }}"
                                    placeholder="Enter an engaging title for your post..."
                                    class="h-12 text-lg font-medium border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                    type="text" autofocus />
                                <p class="text-xs text-gray-500">A compelling title helps readers discover your content
                                </p>
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                                <div class="space-y-2">
                                    <label for="category_id" class="text-base font-medium flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <path
                                                d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                            <line x1="7" y1="7" x2="7.01" y2="7" />
                                        </svg>
                                        <span>Category</span>
                                    </label>
                                    <select id="category_id" name="category_id"
                                        class="h-11 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full">
                                        <option value="">Select a category</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}" @selected(old('category_id')==$category->id)
                                            data-category="{{ $category->name }}">
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <x-input-error :messages="$errors->get('category_id')" class="mt-2" />
                                </div>

                                <div class="space-y-2">
                                    <label for="published_at" class="text-base font-medium flex items-center space-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round">
                                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                                            <line x1="16" y1="2" x2="16" y2="6" />
                                            <line x1="8" y1="2" x2="8" y2="6" />
                                            <line x1="3" y1="10" x2="21" y2="10" />
                                        </svg>
                                        <span>Publish Date</span>
                                    </label>
                                    <input id="published_at" name="published_at" type="datetime-local"
                                        value="{{ old('published_at') }}"
                                        class="h-11 border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block w-full" />
                                    <p class="text-xs text-gray-500">Leave empty to publish immediately</p>
                                    <x-input-error :messages="$errors->get('published_at')" class="mt-2" />
                                </div>
                            </div>

                            <div class="my-6 border-t border-gray-100"></div>

                            <div class="space-y-4">
                                <label for="image" class="text-base font-medium flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                        <circle cx="8.5" cy="8.5" r="1.5" />
                                        <polyline points="21 15 16 10 5 21" />
                                    </svg>
                                    <span>Featured Image</span>
                                </label>

                                <div id="dropzone"
                                    class="relative border-2 border-dashed rounded-xl p-8 text-center transition-all duration-200 border-gray-300 hover:border-gray-400 hover:bg-gray-50">
                                    <input type="file" id="image" name="image" accept="image/*"
                                        class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                                    <div class="space-y-4">
                                        <div
                                            class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400"
                                                width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                                <polyline points="17 8 12 3 7 8" />
                                                <line x1="12" y1="3" x2="12" y2="15" />
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="text-lg font-medium text-gray-900">
                                                Drop your image here, or <span
                                                    class="text-blue-600 hover:text-blue-700 cursor-pointer">browse</span>
                                            </p>
                                            <p class="text-sm text-gray-500 mt-1">Supports: JPG, PNG, GIF up to 10MB</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="image-preview" class="hidden relative group">
                                    <img id="preview-img" src="" alt="Preview"
                                        class="w-full h-64 object-cover rounded-xl">
                                    <div
                                        class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-xl flex items-center justify-center">
                                        <button type="button" id="remove-image"
                                            class="bg-red-600 hover:bg-red-700 text-white px-3 py-2 rounded-full flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24"
                                                height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <line x1="18" y1="6" x2="6" y2="18" />
                                                <line x1="6" y1="6" x2="18" y2="18" />
                                            </svg>
                                            <span>Remove</span>
                                        </button>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('image')" class="mt-2" />
                            </div>

                            <div class="my-6 border-t border-gray-100"></div>

                            <div class="space-y-2">
                                <label for="content" class="text-base font-medium">Content</label>
                                <textarea id="content" name="content"
                                    class="min-h-[400px] resize-none text-base leading-relaxed border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm w-full"
                                    placeholder="Start writing your post content here...">{{ old('content') }}</textarea>
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>Write your post content</span>
                                    <span id="charCount">0 characters</span>
                                </div>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                            </div>

                            <div class="flex justify-end mt-8">
                                <button type="submit"
                                    class="inline-flex items-center px-8 py-2 bg-blue-600 border border-transparent rounded-full font-semibold text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <line x1="22" y1="2" x2="11" y2="13" />
                                        <polygon points="22 2 15 22 11 13 2 9 22 2" />
                                    </svg>
                                    Publish Post
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const titleInput = document.getElementById('title');
            const contentTextarea = document.getElementById('content');
            const categorySelect = document.getElementById('category_id');
            const imageInput = document.getElementById('image');
            const dropzone = document.getElementById('dropzone');
            const imagePreview = document.getElementById('image-preview');
            const previewImg = document.getElementById('preview-img');
            const removeImageBtn = document.getElementById('remove-image');
            const wordCountEl = document.getElementById('wordCount');
            const readTimeEl = document.getElementById('readTime');
            const charCountEl = document.getElementById('charCount');
            const wordStatsEl = document.getElementById('wordStats');

            function updateWordCount() {
                const text = contentTextarea.value.trim();
                const words = text ? text.split(/\s+/).filter(word => word.length > 0).length : 0;
                const readTime = Math.ceil(words / 200); 
                const chars = text.length;
                
                wordCountEl.textContent = `${words} words`;
                readTimeEl.textContent = `${readTime} min read`;
                charCountEl.textContent = `${chars} characters`;
                
                if (words > 0) {
                    wordStatsEl.classList.remove('hidden');
                    wordStatsEl.classList.add('flex');
                } else {
                    wordStatsEl.classList.add('hidden');
                    wordStatsEl.classList.remove('flex');
                }
            }

            function handleImageUpload(file) {
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewImg.src = e.target.result;
                        dropzone.classList.add('hidden');
                        imagePreview.classList.remove('hidden');
                    };
                    reader.readAsDataURL(file);
                }
            }

            contentTextarea.addEventListener('input', updateWordCount);
            
            imageInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    handleImageUpload(this.files[0]);
                }
            });
            
            removeImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                dropzone.classList.remove('hidden');
                imagePreview.classList.add('hidden');
            });

            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                e.preventDefault();
                e.stopPropagation();
            }

            ['dragenter', 'dragover'].forEach(eventName => {
                dropzone.addEventListener(eventName, highlight, false);
            });

            ['dragleave', 'drop'].forEach(eventName => {
                dropzone.addEventListener(eventName, unhighlight, false);
            });

            function highlight() {
                dropzone.classList.add('border-blue-500', 'bg-blue-50');
            }

            function unhighlight() {
                dropzone.classList.remove('border-blue-500', 'bg-blue-50');
            }

            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];
                
                if (file && file.type.startsWith('image/')) {
                    imageInput.files = dt.files;
                    handleImageUpload(file);
                }
            }, false);

            updateWordCount();
        });
    </script>
</x-app-layout>