<div {{ $attributes->merge(['class' => 'd-flex items-center justify-content-between']) }} >
    <div>
        <x-label class="inline-flex items-center m-0">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
            <span class="ml-2 text-sm text-light">{{ __('Remember me') }}</span>
        </x-label>
    </div>

    <div>
        <x-button>{{ __('Sign In') }}</x-button>
    </div>
</div>
