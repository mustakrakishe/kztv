<x-guest-layout>
    <x-slot name="pageTitle">{{ __('Welcome') }}!</x-slot>

    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">

    <div class="min-h-screen flex flex-col justify-center p-0">
        <div id="welcome" class="card">
            <div class="card-body">
                
                <div class="row">

                    <div class="col-8 py-0 px-3">
                        <p>Вітаємо на локальному порталі ПрАТ "Кременчуцький завод технічного вуглецю"!</p>
                        <p>Щоб отримати доступ до сервісів, необхідно увійти в свій аккаунт.</p>
                        <p>Якщо у вас ще немає аккаунта, будь ласка, пройдіть реєстрацію. Ваша заявка на реєстрацію буде автоматично
                            відправлено до відділу АСУ на розгляд. Після схвалення ви зможете скористатися
                            своїми даними авторизації для входу.</p>
                        <p>Довідка: Відділ АСУ, тел. 2-23, 2-55.</p>
                    </div>

                    <div class="col-4 p-0" id="auth">
                        <div class="card m-0">

                            <div class="card-body">
                                <x-views.welcome.auth.cards.authorization id="authorization-card" class="auth-card text-light"/>
                                <x-views.welcome.auth.cards.registration id="registration-card" class="auth-card text-light" hidden/>
                            </div>

                            <div class="card-footer p-0">
                                <div class="row m-0">
                                    <div class="col p-0">
                                        <x-tab name="auth-card" value="authorization-card" onclick="switch_tabs(event); $('.auth-messages').remove();" checked>{{ __('Authorization') }}</x-tab>
                                    </div>
                                    <div class="col p-0">
                                        <x-tab name="auth-card" value="registration-card" onclick="switch_tabs(event); $('.auth-messages').remove();" disabled>{{ __('Registration') }}</x-tab>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/scenarios/devices.js') }}"></script>

</x-guest-layout>