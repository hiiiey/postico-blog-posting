<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <!-- Avatar Section -->
        <div class="space-y-4">
            <label class="text-base font-medium flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10" />
                    <path d="M12 8v8" />
                    <path d="M8 12h8" />
                </svg>
                <span>Profile Picture</span>
            </label>

            <div class="flex items-center space-x-6">
                <div class="relative group">
                    @if ($user->imageUrl())
                    <img src="{{ $user->imageUrl() }}" alt="{{ $user->name }}"
                        class="rounded-full h-24 w-24 object-cover border-2 border-gray-200">
                    @else
                    <div class="rounded-full h-24 w-24 flex items-center justify-center text-white text-2xl font-medium"
                        style="background-color: {{ '#' . substr(md5($user->email), 0, 6) }}">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>
                    @endif
                </div>

                <div id="avatar-upload" class="flex-1">
                    <div id="dropzone"
                        class="relative border-2 border-dashed rounded-xl p-4 text-center transition-all duration-200 border-gray-300 hover:border-gray-400 hover:bg-gray-50">
                        <input type="file" id="image" name="image" accept="image/*"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" />
                        <div id="upload-placeholder" class="space-y-2">
                            <div class="mx-auto w-10 h-10 bg-gray-100 rounded-full flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" width="24"
                                    height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4" />
                                    <polyline points="17 8 12 3 7 8" />
                                    <line x1="12" y1="3" x2="12" y2="15" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900">
                                    Upload a new avatar
                                </p>
                                <p class="text-xs text-gray-500 mt-1">JPG, PNG, GIF up to 2MB</p>
                            </div>
                        </div>

                        <div id="upload-preview" class="hidden">
                            <div class="flex items-center space-x-3">
                                <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 flex-shrink-0">
                                    <img id="preview-thumbnail" src="" alt="Preview" class="w-full h-full object-cover">
                                </div>
                                <div class="text-left">
                                    <p id="selected-filename"
                                        class="text-sm font-medium text-gray-900 truncate max-w-xs"></p>
                                    <div class="flex items-center mt-1">
                                        <span class="flex h-2 w-2 bg-green-500 rounded-full mr-1.5"></span>
                                        <p class="text-xs text-green-600">Ready to upload</p>
                                    </div>
                                </div>
                                <button type="button" id="remove-selected-image"
                                    class="ml-auto p-1 rounded-full text-gray-400 hover:text-red-500 hover:bg-gray-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                    </div>
                    <x-input-error :messages="$errors->get('image')" class="mt-2" />
                </div>
            </div>
        </div>

        <div class="border-t border-gray-100 my-6 pt-4"></div>

        <!-- Basic Information -->
        <div class="space-y-6">
            <h3 class="text-base font-medium flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <circle cx="12" cy="10" r="3"></circle>
                    <path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"></path>
                </svg>
                <span>Personal Information</span>
            </h3>

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                <input id="name" name="name" type="text" value="{{ old('name', $user->name) }}"
                    class="h-10 px-3 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required autofocus />
                <x-input-error :messages="$errors->get('name')" class="mt-1" />
            </div>

            <!-- Username -->
            <div class="space-y-2">
                <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                <div class="relative">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <span class="text-gray-500 sm:text-sm">@</span>
                    </div>
                    <input id="username" name="username" type="text" value="{{ old('username', $user->username) }}"
                        class="h-10 pl-8 px-3 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        required />
                </div>
                <p class="text-xs text-gray-500">This will be used for your profile URL: {{ url('/@') }}<span
                        class="text-gray-700 font-medium">{{ $user->username }}</span></p>
                <x-input-error :messages="$errors->get('username')" class="mt-1" />
            </div>

            <!-- Bio -->
            <div class="space-y-2">
                <label for="bio" class="block text-sm font-medium text-gray-700">Bio</label>
                <textarea id="bio" name="bio" rows="3"
                    class="px-3 py-2 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    placeholder="Tell us a little about yourself...">{{ old('bio', $user->bio) }}</textarea>
                <p class="text-xs text-gray-500">Brief description for your profile. URLs are hyperlinked.</p>
                <x-input-error :messages="$errors->get('bio')" class="mt-1" />
            </div>
        </div>

        <div class="border-t border-gray-100 my-6 pt-4"></div>

        <!-- Contact Information -->
        <div class="space-y-6">
            <h3 class="text-base font-medium flex items-center space-x-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                    <polyline points="22,6 12,13 2,6"></polyline>
                </svg>
                <span>Contact Information</span>
            </h3>

            <!-- Email -->
            <div class="space-y-2">
                <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                <input id="email" name="email" type="email" value="{{ old('email', $user->email) }}"
                    class="h-10 px-3 w-full rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    required />
                <x-input-error :messages="$errors->get('email')" class="mt-1" />

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 flex items-center text-sm text-amber-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2h-1V9z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Your email address is unverified.</span>

                    <button form="send-verification" class="ml-2 underline text-sm text-blue-600 hover:text-blue-800">
                        Click here to resend verification email
                    </button>
                </div>

                @if (session('status') === 'verification-link-sent')
                <div class="mt-2 text-sm font-medium text-green-600 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>A new verification link has been sent to your email address.</span>
                </div>
                @endif
                @endif
            </div>
        </div>

        <div class="border-t border-gray-100 my-6 pt-4"></div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <div>
                @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center text-sm font-medium text-green-600">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" viewBox="0 0 20 20"
                        fill="currentColor">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span>Profile successfully updated!</span>
                </p>
                @endif
            </div>
            <button type="submit"
                class="inline-flex items-center px-6 py-2 bg-blue-600 border border-transparent rounded-full font-semibold text-sm text-white hover:bg-blue-700 focus:bg-blue-700 active:bg-blue-800 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                    <polyline points="17 21 17 13 7 13 7 21"></polyline>
                    <polyline points="7 3 7 8 15 8"></polyline>
                </svg>
                Save Changes
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('image');
            const dropzone = document.getElementById('dropzone');
            const uploadPlaceholder = document.getElementById('upload-placeholder');
            const uploadPreview = document.getElementById('upload-preview');
            const previewThumbnail = document.getElementById('preview-thumbnail');
            const selectedFilename = document.getElementById('selected-filename');
            const removeSelectedImageBtn = document.getElementById('remove-selected-image');

            // Handle file selection
            imageInput.addEventListener('change', function(e) {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    displaySelectedFile(file);
                }
            });

            function displaySelectedFile(file) {
                // Display file preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewThumbnail.src = e.target.result;
                    uploadPlaceholder.classList.add('hidden');
                    uploadPreview.classList.remove('hidden');
                    selectedFilename.textContent = file.name;
                    
                    // Add a "selected" style to the dropzone
                    dropzone.classList.add('border-green-500', 'bg-green-50');
                    dropzone.classList.remove('border-gray-300', 'hover:border-gray-400', 'hover:bg-gray-50');
                };
                reader.readAsDataURL(file);
            }

            // Remove selected image
            removeSelectedImageBtn.addEventListener('click', function() {
                imageInput.value = '';
                uploadPlaceholder.classList.remove('hidden');
                uploadPreview.classList.add('hidden');
                
                // Reset dropzone styling
                dropzone.classList.remove('border-green-500', 'bg-green-50', 'border-blue-500', 'bg-blue-50');
                dropzone.classList.add('border-gray-300', 'hover:border-gray-400', 'hover:bg-gray-50');
            });

            // Drag and drop
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
                if (uploadPreview.classList.contains('hidden')) {
                    dropzone.classList.add('border-blue-500', 'bg-blue-50');
                }
            }

            function unhighlight() {
                if (uploadPreview.classList.contains('hidden')) {
                    dropzone.classList.remove('border-blue-500', 'bg-blue-50');
                }
            }

            dropzone.addEventListener('drop', function(e) {
                const dt = e.dataTransfer;
                const file = dt.files[0];
                
                if (file && file.type.startsWith('image/')) {
                    imageInput.files = dt.files;
                    displaySelectedFile(file);
                }
            }, false);
        });
    </script>
</section>