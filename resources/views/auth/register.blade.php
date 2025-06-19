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
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-input-label for="name" :value="__('Name')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- Role Selection -->
            <div class="mt-4">
                <x-input-label for="role" :value="__('Register as')" />
                <select id="role" name="role" class="form-control" onchange="document.getElementById('admin-code-box').style.display = this.value === 'admin' ? 'block' : 'none';">
                    <option value="customer" {{ old('role') == 'customer' ? 'selected' : '' }}>Customer</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
            </div>
            <!-- Admin Code -->
            <div class="mt-4" id="admin-code-box" style="display: {{ old('role') == 'admin' ? 'block' : 'none' }};">
                <x-input-label for="admin_code" :value="__('Admin Code')" />
                <x-text-input id="admin_code" class="block mt-1 w-full" type="text" name="admin_code" value="{{ old('admin_code') }}" />
                <x-input-error :messages="$errors->get('admin_code')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-300 hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
