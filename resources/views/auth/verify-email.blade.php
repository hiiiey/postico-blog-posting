<x-guest-layout>
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-bold mb-3 text-gray-900">
            Verify Your
            <span
                class="inline-block bg-gradient-to-r from-gray-600 via-gray-800 to-gray-600 bg-clip-text text-transparent bg-[length:200%_100%] animate-gradient">
                Email
            </span>
        </h1>
        <p class="text-gray-600">One last step before you can start</p>
    </div>

    <div class="mb-6 text-gray-600 bg-gray-50 p-4 rounded-lg border border-gray-200">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the
        link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-6 p-4 font-medium text-green-600 bg-green-50 rounded-lg border border-green-200">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

    <div class="mt-8 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit"
                class="text-sm text-gray-600 hover:text-gray-900 transition-colors flex items-center group">
                <span>{{ __('Log Out') }}</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform">
                    <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                    <polyline points="16 17 21 12 16 7"></polyline>
                    <line x1="21" y1="12" x2="9" y2="12"></line>
                </svg>
            </button>
        </form>
    </div>
</x-guest-layout>