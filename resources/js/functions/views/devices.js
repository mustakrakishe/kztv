function generate_device_form(){
    return $(table_row_form).clone(true, true); // table_row_form from the Devices view
}

function bind_new_device_form_handlers(new_device_form, handlers){
    let btn_add_device = $(new_device_form).find('button.ok');
    let btn_cancel_add_device = $(new_device_form).find('button.cancel');
    $(btn_add_device).on('click', handlers.ok);
    $(btn_cancel_add_device).on('click', handlers.cancel);
    return $(new_device_form);
}

function insert_new_device_form(destination, new_device_form){
    $(destination).prepend($(new_device_form));
}

function get_active_new_device_form(event){
    let activated_btn = event.currentTarget;
    let active_new_device_form = $(activated_btn).parents().eq(4);
    return active_new_device_form;
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

function save_new_device_input_data(input_data){
    return $.post({
        url: add_device_handler_link, // add_device_handler_link from the Devices view
        data: input_data
    });
}

function generate_device_log(device){
    return $.ajax({
        url: get_table_row_device_handler_link, // get_table_row_device_handler_link from the Devices view
        data: device,
        dataType: 'html'
    });
}

function bind_device_log_handlers(new_device_log, handlers){
    let btn_edit_device = $(new_device_log).find('button.edit');
    let btn_delete_device = $(new_device_log).find('button.delete');
    $(btn_edit_device).on('click', handlers.edit);
    $(btn_delete_device).on('click', handlers.delete);
    return $(new_device_log);
}

function show_device_log(destination, device_log){
    $(destination).after($(device_log));
}

function get_active_device_log(event){
    let activated_btn = event.currentTarget;
    let active_device_log = $(activated_btn).parents().eq(4);
    return active_device_log;
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

function delete_device_from_db_by_id(device_id){
    return $.ajax({
        url: del_device_handler_link,
        data: {id: device_id}
    }); // del_device_handler_link from the Devices view
}

function fill_form_with_data(device_edit_form, device_data){
    for(let param_name in device_data){
        $(device_edit_form).find('input[name="' + param_name + '"]').val(device_data[param_name]);
    }
    return device_edit_form;
}

function bind_device_edit_form_handlers(device_edit_form, handlers){
    let btn_update_device = $(device_edit_form).find('button.ok');
    let btn_cancel_update_device = $(device_edit_form).find('button.cancel');
    $(btn_update_device).on('click', handlers.ok);
    $(btn_cancel_update_device).on('click', handlers.cancel);
    return $(device_edit_form);
}

function insert_device_edit_form(destination, new_device_form){
    $(destination).after($(new_device_form));
}

function get_active_device_edit_form(event){
    let activated_btn = event.currentTarget;
    let active_device_edit_form = $(activated_btn).parents().eq(4);
    return active_device_edit_form;
}

function get_device_by_id(id){
    return $.ajax({
        url: get_device_by_id_handler_link,
        data: {id: id}
    });
}