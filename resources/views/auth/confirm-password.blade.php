<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold mb-3 text-gray-900">
            Security
            <span
                class="inline-block bg-gradient-to-r from-gray-600 via-gray-800 to-gray-600 bg-clip-text text-transparent bg-[length:200%_100%] animate-gradient">
                Check
            </span>
        </h1>
        <p class="text-gray-600">Please confirm your password to continue</p>
    </div>

    <div class="mb-6 text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-200">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex justify-end mt-8">
            <x-primary-button>
                {{ __('Confirm') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>