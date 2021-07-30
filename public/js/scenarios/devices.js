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

function add_device_to_db(input_data){
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

function update_device_in_db(device){
    return $.ajax({
        url: upd_device_handler_link, // upd_device_handler_link from the Devices view
        data: {'device': device}
    })
}

function get_device_by_id(id){
    return $.ajax({
        url: get_device_by_id_handler_link,
        data: {id: id}
    })
}
// при добавлении нового устройства он не добавляется в таблицу
function show_new_device_form(){
    let destination = $('table#device_table').children('tbody');
    let new_device_form = generate_device_form();

    let handlers= {
        ok: add_new_device,
        cancel: cancel_add_new_device_form
    }
    new_device_form = bind_new_device_form_handlers(new_device_form, handlers);

    insert_new_device_form(destination, new_device_form);
}

    function add_new_device(event){
        let new_device_form = get_active_new_device_form(event);
        let input_data = get_form_data(new_device_form);
        add_device_to_db(input_data)
            .done((new_device_id) => {
                let destination = $(new_device_form);
                let new_device = Object.assign(input_data, {id: new_device_id});
                generate_device_log(new_device)
                    .done(new_device_log => {
                        let handlers= {
                            edit: show_device_edit_form,
                            delete: delete_device
                        }
                        new_device_log = bind_device_log_handlers($(new_device_log), handlers);
                        show_device_log(destination, new_device_log);
                        $(new_device_form).remove();
                    })
            });
        
    }

    function cancel_add_new_device_form(event){
        let new_device_form = get_active_new_device_form(event);
        $(new_device_form).remove();
    }

function show_device_edit_form(event){
    let active_device_log = get_active_device_log(event);
    let device_data = get_device_log_data(active_device_log);
    let destination = $(active_device_log);
    
    let device_edit_form = generate_device_form();
    let handlers = {
        ok: update_device,
        cancel: cancel_update_device
    }
    device_edit_form = bind_device_edit_form_handlers(device_edit_form, handlers);
    device_edit_form = fill_form_with_data(device_edit_form, device_data);

    insert_device_edit_form(destination, device_edit_form);
    $(active_device_log).remove();
}

function update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let input_data = get_form_data(active_device_edit_form);
    update_device_in_db(input_data)
    .done(() => {
        get_device_by_id(input_data.id)
        .done(updated_device => {
            updated_device = JSON.parse(updated_device);
            generate_device_log(updated_device)
            .done(updated_device_log => {
                let handlers= {
                    edit: show_device_edit_form,
                    delete: delete_device
                }
                updated_device_log = bind_device_log_handlers($(updated_device_log), handlers);
                let destination = $(active_device_edit_form);
                show_device_log(destination, updated_device_log);
                $(active_device_edit_form).remove();
            });
        });
    });
}

function cancel_update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let device_id = $(active_device_edit_form).find('input[name="id"]').val();
    get_device_by_id(device_id)
    .done(device_old_data => {
        device_old_data = JSON.parse(device_old_data);
        generate_device_log(device_old_data)
            .done(old_device_log => {
                let handlers= {
                    edit: show_device_edit_form,
                    delete: delete_device
                }
                old_device_log = bind_device_log_handlers($(old_device_log), handlers);
                let destination = $(active_device_edit_form);
                show_device_log(destination, old_device_log);
                $(active_device_edit_form).remove();
            })
    })
}

function delete_device(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    delete_device_from_db_by_id(device_id)
        .done(() => {
            $(active_device_log).remove();
        })
}
// table_row_form = set_form_btn_handlers($(table_row_form)); // table_row_form from the Devices view

$('button#new_device').on('click', show_new_device_form);

$('table#device_table').find('button.edit').on('click', show_device_edit_form);
$('table#device_table').find('button.delete').on('click', delete_device);