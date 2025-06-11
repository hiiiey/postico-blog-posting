<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Create Account</h2>
        <p class="text-sm text-gray-600">Begin your blogging journey today</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" class="text-gray-700 text-sm" />
            <x-text-input id="name"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                placeholder="Enter your name" />
            <x-input-error :messages="$errors->get('name')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="username" :value="__('Username')" class="text-gray-700 text-sm" />
            <x-text-input id="username"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="text" name="username" :value="old('username')" required autocomplete="username"
                placeholder="Choose a username" />
            <x-input-error :messages="$errors->get('username')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm" />
            <x-text-input id="email"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="email" name="email" :value="old('email')" required autocomplete="username"
                placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm" />
            <x-text-input id="password"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div>
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 text-sm" />
            <x-text-input id="password_confirmation"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="password" name="password_confirmation" required autocomplete="new-password"
                placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 px-4 rounded-md transition-all duration-300 transform hover:translate-y-[-1px] hover:shadow-md text-sm">
                {{ __('SIGN UP') }}
            </button>
        </div>

        <div class="mt-4 text-center text-sm text-gray-600">
            {{ __("Already have an account?") }}
            <a href="{{ route('login') }}"
                class="text-blue-500 hover:text-blue-700 hover:underline font-medium transition-colors">
                {{ __('Sign in') }}
            </a>
        </div>
    </form>
</x-guest-layout>