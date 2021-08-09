function add_device_to_db(input_data){
    return $.post({
        url: links.add_device, // links from the Devices view
        data: input_data
    });
}

function delete_device_from_db(device_id){
    return $.ajax({
        url: links.delete_device, // links from the Devices view
        data: {id: device_id}
    });
}

function fill_device_form(form, device){
    for(let param_name in device){
        $(form).find('input[name="' + param_name + '"]').val(device[param_name]);
    }
    return form;
}

function generate_edit_device_form(device){
    let form = table_rows.edit_device_form;  // table_rows from the Devices view
    form = fill_device_form($(form), device);
    return form;
}

function get_active_device_edit_form(event){
    let activated_btn = event.currentTarget;
    let active_device_edit_form = $(activated_btn).parents().eq(4);
    return active_device_edit_form;
}

function get_active_device_log(event){
    let activated_btn = event.currentTarget;
    let active_device_log = $(activated_btn).parents().eq(4);
    return active_device_log;
}

function get_active_new_device_form(event){
    let activated_btn = event.currentTarget;
    let active_new_device_form = $(activated_btn).parents().eq(4);
    return active_new_device_form;
}

function get_device_form(device_id = null){
    return $.ajax({
        url: links.get_device_form, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_log_data(device_log){
    let device_log_data = {};

    let fields = $(device_log).find('.info');
    $(fields).each((index, field) => {
        let name = $(field).attr('name');
        let value = $(field).text();
        device_log_data[name] = value;
    });

    return device_log_data;
}

function get_form_data(form){
    let form_data = {};

    $(form).find('input')
    .each((index, input) => {
        let name = $(input).attr('name');
        let value = $(input).val();
        form_data[name] = value;
    });

    if(!form_data.hasOwnProperty('type')){
        let select = $(form).find('select[name="type"]');
        let value = $(select).children('option:selected').text();
        form_data['type'] = value;
    }

    return form_data;
}

function get_form_old_data(form){
    let form_old_data = {};

    $(form).find('input')
    .each((index, input) => {
        let name = $(input).attr('name');
        let value = $(input).attr('old_value');
        form_old_data[name] = value;
    });

    return form_old_data;
}

function preteat_form_data(form_data){
    form_data.identification_code = form_data.identification_code.match(/\d+/);
    return form_data;
}

function preteat_log_data(log_data){
    let identification_code = log_data.identification_code;
    if(identification_code){
        log_data.identification_code = '(' + log_data.identification_code + ')';
    }
    return log_data;
}

function save_form_old_data(form){
    $(form).find('input').each((index, input) => {
        $(input).attr('old_value', $(input).val());
    });
    return form;
}

function update_device_in_db(device){
    return $.ajax({
        url: links.update_device, // links from the Devices view
        data: device
    })
}