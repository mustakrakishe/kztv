$('.del_device').on('click', function(){
    let device_id = $(this).val();
    
    $.ajax(
        {
            url: json_encode(<?php echo {{ route('devices.delete') }}; ?>),
            data: device_id
        }
    ).done((result) => {
        $(this).parent().parent().remove();
        console.log('Device id' + device_id + ' is deleted.');
    })
})