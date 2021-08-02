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

function fill_device_log(log, device){
    for(let param_name in device){
        $(log).find('.info[name="' + param_name + '"]').text(device[param_name]);
    }
    return log;
}

function generate_edit_device_form(device){
    let form = table_rows.edit_device_form;  // table_rows from the Devices view
    form = fill_device_form($(form), device);
    return form;
}

function generate_device_log(device){
    let device_log = table_rows.device_log;  // table_rows from the Devices view
    device_log = fill_device_log($(device_log), device);
    return device_log;
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

function get_device_by_id(id){
    return $.ajax({
        url: get_device_by_id_handler_link,
        data: {id: id}
    })
}
function get_device_log_by_id(id){
    return $.ajax({
        url: get_device_log_by_id_handler_link,
        data: {id: id}
    })
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

function get_new_device_log_destination(){
    return $('table#device_table').children('tbody').children('tr.log_row').first();
}

function save_form_old_data(form){
    $(form).find('input').each((index, input) => {
        $(input).attr('old_value', $(input).val());
    });
    return form;
}

function show_updated_device_log(destination, updated_device_log){
    $(destination).after($(updated_device_log));
}

function show_new_device_log(destination, new_device_log){
    $(destination).before($(new_device_log));
}

function update_device_in_db(device){
    return $.ajax({
        url: links.update_device, // links from the Devices view
        data: device
    })
}