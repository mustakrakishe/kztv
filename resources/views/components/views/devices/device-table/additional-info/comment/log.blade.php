<div class="row">
    <div class="col text-right mt-auto" style="padding: 8px 20px;">
        <label class="btn btn-link m-0 p-0"">
            <button name="btn_edit_device_comment" value="{{ $deviceId }}" onclick="show_device_comment_edit_form(event)" hidden></button>
            <i class="fas fa-pen"></i>
        </label>
    </div>
</div>

<div class="row comment-content">
    <div class="cell">{{ $comment }}</div>
</div>