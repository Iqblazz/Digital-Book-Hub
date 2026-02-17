<x-guest-layout>
    <div class="mb-6 text-center">
        <h2 class="text-2xl font-bold text-gray-900">
            Reset Your Password
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            Enter your email address and we’ll send you a password reset link so you can create a new one.
        </p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-6">
            <x-primary-button class="w-full justify-center bg-blue-600 hover:bg-blue-700 active:bg-blue-800">
                {{ __('Send Reset Link') }}
            </x-primary-button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:text-blue-800 underline">
                Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>