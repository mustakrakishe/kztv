<div class="row additional-info">

    <x-devices.table.additional-info.section class="col-4">
        <x-slot name="title">Статус</x-slot>
        <x-slot name="content">
            <p class="mx-auto">2021-08-01: Новий</p>
        </x-slot>
    </x-devices.table.additional-info.section>

    <x-devices.table.additional-info.section class="col-8">
        <x-slot name="title">Історія переміщення</x-slot>
        <x-slot name="content">
            <x-table class="movement-history">
                <x-slot name="head">
                    <div class="col-3">Дата</div>
                    <div class="col-5">Розташування</div>
                    <div class="col-4">Коментар</div>
                </x-slot>

                <x-slot name="body">
                    @isset($movementHistory)
                        @foreach($movementHistory as $log)
                        <div class="row table-row">
                            <div class="col-3">{{ $log->created_at }}</div>
                            <div class="col-5">{{ $log->location }}</div>
                            <div class="col-4">{{ $log->comment }}</div>
                        </div>
                        @endforeach
                    @endisset
                </x-slot>
            </x-table>
        </x-slot>
    </x-devices.table.additional-info.section>

</div>