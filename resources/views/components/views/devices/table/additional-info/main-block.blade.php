<div class="row additional-info">

    <x-views.devices.table.additional-info.section class="col-3">
        <x-slot name="title">Статус</x-slot>
        <x-slot name="content">
            <p class="mx-auto">2021-08-01: Новий</p>
        </x-slot>
    </x-views.devices.table.additional-info.section>

    <x-views.devices.table.additional-info.section class="col-7">
        <x-slot name="title">Історія переміщення</x-slot>
        <x-slot name="content">
            <x-table class="movement-history">
                <x-slot name="head">
                    <div class="cell col-3">Дата</div>
                    <div class="cell col-5">Розташування</div>
                    <div class="cell col-4">Коментар</div>
                </x-slot>

                <x-slot name="body">
                    @isset($movementHistory)
                        @foreach($movementHistory as $log)
                        <div class="row table-row">
                            <div class="cell col-3">{{ $log->created_at }}</div>
                            <div class="cell col-5">{{ $log->location }}</div>
                            <div class="cell col-4">{{ $log->comment }}</div>
                        </div>
                        @endforeach
                    @endisset
                </x-slot>
            </x-table>
        </x-slot>
    </x-views.devices.table.additional-info.section>

</div>