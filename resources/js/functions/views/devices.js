function add_device_to_db(input_data){
    return $.post({
        url: links.add_device, // links from the Devices view
        data: input_data
    });
}

function collapse_block(block, speed){
    return new Promise(resolve => {
        $(block).animate({
            height: 0,
            padding: 0
        }, speed, function(){
            resolve(block);
        });
    });
}

function delete_device_from_db(device_id){
    return $.ajax({
        url: links.delete_device, // links from the Devices view
        data: {id: device_id}
    });
}

function expand_block(block, speed){
    return new Promise(resolve => {
        let finish_height = $(block).height();
        let finish_margin = $(block).css('margin');
        let finish_padding = $(block).css('padding');

        $(block).css({
            'height': 0,
            'margin-top': 0,
            'margin-bottom': 0,
            'padding-top': 0,
            'padding-bottom': 0,
        })

        $(block).animate({
            height: finish_height,
            margin: finish_margin,
            padding: finish_padding
        }, speed, function(){
            resolve(block);
        });
    });
}

function get_active_device_edit_form(event){
    let activated_btn = event.currentTarget;
    let active_device_edit_form = $(activated_btn).parents().eq(6);
    return active_device_edit_form;
}

function get_active_device_log(event){
    let activated_btn = event.currentTarget;
    let active_device_log = $(activated_btn).parents().eq(6);
    return active_device_log;
}

function get_active_new_device_form(event){
    let activated_btn = event.currentTarget;
    let active_new_device_form = $(activated_btn).parents().eq(6);
    return active_new_device_form;
}

function get_device_form(device_id = null){
    return $.ajax({
        url: links.get_device_form, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_log(device_id){
    return $.ajax({
        url: links.get_device_log, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_log_data(device_log){
    let device_log_data = {};

    let fields = $(device_log).find('.main-info').find('.info');
    $(fields).each((index, field) => {
        let name = $(field).attr('name');
        let value = $(field).text();
        device_log_data[name] = value;
    });

    return device_log_data;
}

function get_device_more_info(device_id){
    return $.ajax({
        url: links.get_device_more_info, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_form_data(form){
    let form_data = {};

    $(form).find('.main-info').find('input')
    .each((index, input) => {
        let name = $(input).attr('name');
        let value = $(input).val();
        form_data[name] = value;
    });

    if(!form_data.hasOwnProperty('type')){
        let select = $(form).find('.main-info').find('select[name="type"]');
        let value = $(select).children('option:selected').text();
        form_data['type'] = value;
    }

    return form_data;
}

function update_device_in_db(device){
    return $.ajax({
        url: links.update_device, // links from the Devices view
        data: device
    })
}