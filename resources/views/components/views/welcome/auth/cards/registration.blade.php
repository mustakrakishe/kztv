<div {{ $attributes }}>
    <x-views.welcome.auth.messages.session-status class="mb-4" :status="session('status')" />
    <x-views.welcome.auth.messages.validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div>
            <x-label for="reg_login" :value="__('Login')" />
            <x-input id="reg_login" class="block mt-1 w-full" type="login" name="login" :value="old('login')" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="reg_password" :value="__('Password')" />
            <x-input id="reg_password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="mt-4">
            <div class="d-flex items-center justify-content-end">
                <div>
                    <x-button class="float-end">
                        {{ __('Sign Up') }}
                    </x-button>
                </div>
            </div>
        </div>
    </form>
</div>