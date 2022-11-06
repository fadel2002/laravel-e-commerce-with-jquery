<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <div class="grid row my-4 gap-4">
            <x-input-label :value="__('Welcome to My Warung! 👋')"> </x-input-label>

            <x-input-label :value="__('Please sign-in to your account and start shopping')"> </x-input-label>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />

                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus />

                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">

                <div class="grid grid-cols-2">
                    <x-input-label for="password" :value="__('Password')" />

                    @if (Route::has('password.request'))
                    <a class=" text-sm text-green-600 hover:text-green-900 left flex justify-end"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                    @endif
                </div>

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />

            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                        name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class=" mt-4 ">
                <x-primary-button class="w-full flex justify-center">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>

            <div class="flex items-center justify-center mt-5 mb-4 text-sm text-green-600">
                <x-input-label :value="__('New To Our Platform?')" />
                <a href="{{ route('register') }}">&nbsp Create An Account</a>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>