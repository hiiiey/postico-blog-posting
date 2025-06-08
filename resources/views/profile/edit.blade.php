<x-app-layout>
    <div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-slate-50 py-8">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Account Settings</h1>
                <p class="text-gray-600">Manage your profile information and account preferences</p>
            </div>

            <!-- Settings Container -->
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <!-- Tabs -->
                <div class="border-b border-gray-200"
                    x-data="{ activeTab: window.location.hash ? window.location.hash.substring(1) : 'personal' }">
                    <div class="flex overflow-x-auto">
                        <button @click="activeTab = 'personal'; window.location.hash = 'personal'"
                            :class="{ 'border-blue-500 text-blue-600': activeTab === 'personal', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'personal' }"
                            class="py-4 text-center border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                            <span>Personal Information</span>
                        </button>

                        <button @click="activeTab = 'security'; window.location.hash = 'security'"
                            :class="{ 'border-blue-500 text-blue-600': activeTab === 'security', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'security' }"
                            class="py-4 text-center border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                            </svg>
                            <span>Password & Security</span>
                        </button>

                        <button @click="activeTab = 'account'; window.location.hash = 'account'"
                            :class="{ 'border-blue-500 text-blue-600': activeTab === 'account', 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300': activeTab !== 'account' }"
                            class="py-4 text-center border-b-2 font-medium text-sm flex items-center space-x-2 whitespace-nowrap px-6">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="12" cy="12" r="10"></circle>
                                <path d="M12 8v8"></path>
                                <path d="M8 12h8"></path>
                            </svg>
                            <span>Account Management</span>
                        </button>
                    </div>

                    <!-- Personal Information Tab Panel -->
                    <div x-show="activeTab === 'personal'" class="p-6 space-y-6">
                        <div class="pb-6 border-b">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                                <h2 class="text-xl font-bold">Profile Information</h2>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Update your personal information and how others see
                                you on the platform</p>
                        </div>
                        <div class="space-y-6">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Password & Security Tab Panel -->
                    <div x-show="activeTab === 'security'" class="p-6 space-y-6">
                        <div class="pb-6 border-b">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                                </svg>
                                <h2 class="text-xl font-bold">Password & Security</h2>
                            </div>
                            <p class="text-sm text-gray-600 mt-1">Update your password to keep your account secure</p>
                        </div>
                        <div class="space-y-6">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Account Management Tab Panel -->
                    <div x-show="activeTab === 'account'" class="p-6 space-y-6">
                        <div class="pb-6 border-b">
                            <div class="flex items-center space-x-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round">
                                    <path
                                        d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z">
                                    </path>
                                    <line x1="12" y1="9" x2="12" y2="13"></line>
                                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                                </svg>
                                <h2 class="text-xl font-bold text-red-900">Danger Zone</h2>
                            </div>
                            <p class="text-sm text-red-700 mt-1">Irreversible and destructive actions</p>
                        </div>
                        <div class="space-y-6">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Check for hash on page load and set the active tab accordingly
        document.addEventListener('DOMContentLoaded', function() {
            // If there's a hash, set it to the active tab
            if (window.location.hash) {
                const hash = window.location.hash.substring(1);
                if (['personal', 'security', 'account'].includes(hash)) {
                    const tabEvent = new CustomEvent('tab-changed', { detail: { tab: hash } });
                    document.dispatchEvent(tabEvent);
                }
            }
        });
    </script>
</x-app-layout>