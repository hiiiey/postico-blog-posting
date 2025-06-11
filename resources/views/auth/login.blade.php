<x-guest-layout>
    <div class="mb-4">
        <h2 class="text-2xl font-semibold text-gray-900 mb-1">Sign In</h2>
        <p class="text-sm text-gray-600">Welcome back to your blogging journey</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" class="text-gray-700 text-sm" />
            <x-text-input id="email"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                placeholder="Enter your email" />
            <x-input-error :messages="$errors->get('email')" class="mt-1" />
        </div>

        <div>
            <div class="flex items-center justify-between">
                <x-input-label for="password" :value="__('Password')" class="text-gray-700 text-sm" />
                @if (Route::has('password.request'))
                <a class="text-xs text-blue-500 hover:text-blue-700 transition-colors hover:underline"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot password?') }}
                </a>
                @endif
            </div>
            <x-text-input id="password"
                class="block mt-1 w-full h-10 text-sm border-gray-300 focus:border-gray-500 focus:ring focus:ring-gray-200 focus:ring-opacity-50 rounded-md shadow-sm transition-colors"
                type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
            <x-input-error :messages="$errors->get('password')" class="mt-1" />
        </div>

        <div class="block">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-blue-500 shadow-sm focus:ring-blue-500 transition-colors"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div>
            <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-medium py-2.5 px-4 rounded-md transition-all duration-300 transform hover:translate-y-[-1px] hover:shadow-md text-sm">
                {{ __('SIGN IN') }}
            </button>
        </div>

        <div class="relative my-4 text-center">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-white px-2 text-gray-500">or</span>
            </div>
        </div>

        <div class="mt-2 text-center text-sm text-gray-600">
            {{ __("Are you new?") }}
            <a href="{{ route('register') }}"
                class="text-blue-500 hover:text-blue-700 hover:underline font-medium transition-colors">
                {{ __('Create an Account') }}
            </a>
        </div>
    </form>
</x-guest-layout>