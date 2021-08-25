@props(['id' => null])

<div {{ $attributes->merge(['class' => 'row']) }}>
    <div class="col-4">
        <label class="btn btn-link m-0 p-0">
            <button class="more" value="{{ $id }}" onclick="show_device_more_info(event)" hidden></button>
            <i class="far fa-window-maximize"></i>
        </label>
    </div>
    <div class="col-4">
        <label class="btn btn-link m-0 p-0">
            <button class="edit" value="{{ $id }}" onclick="show_device_edit_form(event)" hidden></button>
            <i class="fas fa-pen"></i>
        </label>
    </div>
    <div class="col-4">
        <label class="btn btn-link m-0 p-0">
            <button class="delete" value="{{ $id }}" onclick="delete_device(event)" hidden></button>
            <i class="fas fa-trash-alt"></i>
        </label>
    </div>
</div>