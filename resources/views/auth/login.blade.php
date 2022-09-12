<x-guest-layout>
    <x-auth-card class="dark:bg-slate-800">
        <x-slot name="logo">
            <x-application-logo class="w-32 text-white fill-current" />
        </x-slot>
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />



        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="dark:bg-slate-800">
                <label for="email">Email</label>
                <x-input id="email"
                    class="block w-full mt-1 dark:focus:ring-1 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 dark:placeholder-gray-400 "
                    type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <label for="password">Password</label>
                <input id="password" class="block mt-1" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center dark:text-gray-300">
                    <input id="remember_me" type="checkbox" name="remember">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="text-sm text-gray-600 underline dark:text-gray-300 hover:text-gray-900"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <button type="submit" class="ml-4 btn-primary">
                    Log in
                </button>
            </div>
        </form>

    </x-auth-card>
</x-guest-layout>