@props(['id'])

<div class="row">
    <div class="col-6">
        <label class="btn btn-link m-0 p-0">
            <button class="edit" value="{{ $id }}" onclick="show_movement_log_edit_form(event)" hidden></button>
            <i class="fas fa-pen"></i>
        </label>
    </div>
    <div class="col-6">
        <label class="btn btn-link m-0 p-0">
            <button class="delete" value="{{ $id }}" onclick="delete_movement_log(event)" hidden></button>
            <i class="fas fa-trash-alt"></i>
        </label>
    </div>
</div>