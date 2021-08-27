<form onsubmit="update_device_comment(event)" onreset="cancel_update_device_comment(event)">

    <div class="row">
        <div class="col text-right mt-auto" style="padding: 8px 20px;">
                <label class="btn btn-link m-0 p-0">
                    <!-- <button class="ok" onclick="update_device_comment(event)" hidden></button> -->

                    <button type="submit" hidden></button>
                    <i class="fas fa-check"></i>
                </label>
                <label class="btn btn-link m-0 p-0">
                    <!-- <button class="cancel" onclick="cancel_update_device_comment(event)" hidden></button> -->

                    <button type="reset" name="id" hidden></button>
                    <i class="fas fa-ban"></i>
                </label>
        </div>
    </div>

    <div class="row comment-content">
        @csrf
        <input type="text" name="device_id" value="{{ $device_id }}" hidden>
        <textarea name="comment" class="form-control cell" cols="30" rows="3" placeholder="{{ __('Comment') }}...">{{ $comment }}</textarea>
    </div>

</form>