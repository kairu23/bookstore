<style>
    body {
        background-image: url('/img/bookshelf.jpeg');
        background-size: cover;
        background-position: center;
        backdrop-filter: blur(6px);
        -webkit-backdrop-filter: blur(6px);
        min-height: 100vh;
    }

    .auth-container {
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 12px;
        padding: 2rem;
        max-width: 420px;
        margin: 80px auto;
        color: white;
    }
</style>

<x-guest-layout>
    <div class="auth-container">
        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />
        <h2 class="text-2xl font-semibold mb-6 text-center text-white">Welcome Dear Reader 👋</h2>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                    type="password"
                    name="password"
                    required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                    <span class="ms-2 text-sm text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <!-- Register Link -->
            <div class="mt-4 text-center">
                <a href="{{ route('register') }}"
                    class="inline-block text-sm text-white bg-gray-700 hover:bg-gray-600 px-4 py-2 rounded">
                    📝 Don’t have an account? Register
                </a>
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-400 hover:text-white" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
