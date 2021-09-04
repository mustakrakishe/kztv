<div {{ $attributes }}>
    <x-views.welcome.auth.messages.session-status class="mb-4" :status="session('status')" />
    <x-views.welcome.auth.messages.validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-label for="auth_login" :value="__('Login')" />
            <x-input id="auth_login" class="block mt-1 w-full" type="login" name="login" :value="old('login')" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="auth_password" :value="__('Password')" />
            <x-input id="auth_password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="mt-4">
            <div class="d-flex items-center justify-content-between">
                <div>
                    <x-label class="inline-flex items-center m-0">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                        <span class="ml-2 text-sm text-light">{{ __('Remember me') }}</span>
                    </x-label>
                </div>

                <div>
                    <x-button>{{__('Sign In')}}</x-button>
                </div>
            </div>
        </div>
    </form>
</div>