function add_device_to_db(input_data){
    return $.post({
        url: add_device_handler_link, // add_device_handler_link from the Devices view
        data: input_data
    });
}

function bind_device_edit_form_handlers(device_edit_form, handlers){
    let btn_update_device = $(device_edit_form).find('button.ok');
    let btn_cancel_update_device = $(device_edit_form).find('button.cancel');
    $(btn_update_device).on('click', handlers.ok);
    $(btn_cancel_update_device).on('click', handlers.cancel);
    return $(device_edit_form);
}

function bind_device_log_handlers(new_device_log, handlers){
    let btn_edit_device = $(new_device_log).find('button.edit');
    let btn_delete_device = $(new_device_log).find('button.delete');
    $(btn_edit_device).on('click', handlers.edit);
    $(btn_delete_device).on('click', handlers.delete);
    return $(new_device_log);
}

function bind_new_device_form_handlers(new_device_form, handlers){
    let btn_add_device = $(new_device_form).find('button.ok');
    let btn_cancel_add_device = $(new_device_form).find('button.cancel');
    $(btn_add_device).on('click', handlers.ok);
    $(btn_cancel_add_device).on('click', handlers.cancel);
    return $(new_device_form);
}

function delete_device_from_db_by_id(device_id){
    return $.ajax({
        url: del_device_handler_link, // del_device_handler_link from the Devices view
        data: {id: device_id}
    });
}

function fill_form_with_data(device_edit_form, device_data){
    for(let param_name in device_data){
        $(device_edit_form).find('input[name="' + param_name + '"]').val(device_data[param_name]);
    }
    return device_edit_form;
}

function generate_device_form(){
    return $(table_row_form).clone(true, true); // table_row_form from the Devices view
}

function generate_device_log(device){
    return $.ajax({
        url: get_table_row_device_handler_link, // get_table_row_device_handler_link from the Devices view
        data: device,
        dataType: 'html'
    });
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

function get_device_log_data(device_log){
    let fields = $(device_log).find('.info');
    let device_log_data = {};
    $(fields).each((index, field) => {
        let name = $(field).attr('name');
        let value = $(field).text();
        device_log_data[name] = value;
    });
    return device_log_data;
}

function get_form_data(form){
    let inputs = $(form).find('input');
    let form_data = {};
    $(inputs).each((index, input) => {
        let name = $(input).attr('name');
        let value = $(input).val();
        form_data[name] = value;
    });
    return form_data;
}

function get_new_device_log_destination(){
    return $('table#device_table').children('tbody').children('tr.log_row').first();
}

function show_updated_device_log(destination, updated_device_log){
    $(destination).after($(updated_device_log));
}

function show_new_device_log(destination, new_device_log){
    $(destination).before($(new_device_log));
}

function update_device_in_db(device){
    return $.ajax({
        url: upd_device_handler_link, // upd_device_handler_link from the Devices view
        data: {'device': device}
    })
}