<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold mb-3 text-gray-900">
            Reset Your
            <span
                class="inline-block bg-gradient-to-r from-gray-600 via-gray-800 to-gray-600 bg-clip-text text-transparent bg-[length:200%_100%] animate-gradient">
                Password
            </span>
        </h1>
        <p class="text-gray-600">We'll send you a link to reset your password</p>
    </div>

    <div class="mb-6 text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-200">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password
        reset link that will allow you to choose a new one.') }}
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-8">
            <a class="text-sm text-gray-600 hover:text-gray-900 transition-colors" href="{{ route('login') }}">
                {{ __('Back to login') }}
            </a>

            <x-primary-button>
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>