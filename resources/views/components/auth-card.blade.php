<div {{ $attributes }}>
    <x-auth-session-status class="mb-4" :status="session('status')" />
    <x-auth-validation-errors class="mb-4" :errors="$errors" />

    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div>
            <x-label for="login" :value="__('Login')" />
            <x-input id="login" class="block mt-1 w-full" type="email" name="email" :value="old('login')" required autofocus />
        </div>

        <div class="mt-4">
            <x-label for="password" :value="__('Password')" />
            <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        </div>

        <div class="mt-4">
            <div id="sign-in-actions" class="auth-actions">
                <x-views.welcome.auth-card.action-sections.sign-in/>
            </div>
            <div id="sign-up-actions" class="auth-actions" hidden>
                <x-views.welcome.auth-card.action-sections.sign-up/>
            </div>
        </div>
    </form>
</div>