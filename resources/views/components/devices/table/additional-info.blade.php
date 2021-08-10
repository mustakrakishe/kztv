<div class="row additional-info">
    <div class="col-4"></div>
    <div class="col-8">
        <div class="row table-title"><p class="mx-auto my-0">Історія переміщення</p></div>
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
        </div>
    </div>
</div>