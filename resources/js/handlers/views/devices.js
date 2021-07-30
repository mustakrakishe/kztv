// при добавлении нового устройства он не добавляется в таблицу
function show_new_device_form(){
    let new_device_form = generate_device_form();

    let handlers= {
        ok: add_new_device,
        cancel: cancel_add_new_device_form
    }
    new_device_form = bind_new_device_form_handlers(new_device_form, handlers);
    $('table#device_table').children('tbody').prepend($(new_device_form));
}

    function add_new_device(event){
        let new_device_form = get_active_new_device_form(event);
        let input_data = get_form_data(new_device_form);
        add_device_to_db(input_data)
        .done((new_device_id) => {
            get_device_by_id(new_device_id)
            .done(new_device => {
                new_device = JSON.parse(new_device);
                generate_device_log(new_device)
                .done(new_device_log => {
                    let handlers= {
                        edit: show_device_edit_form,
                        delete: delete_device
                    }
                    new_device_log = bind_device_log_handlers($(new_device_log), handlers);
                    let table_last_log = $('table#device_table').children('tbody').children('.log_row:first');
                    if(table_last_log.length){
                        $(table_last_log).before($(new_device_log));
                    }
                    else{
                        $('table#device_table').children('tbody').append($(new_device_log));
                    }
                    $(new_device_form).remove();
                });
            });
        });
    }

function cancel_add_new_device_form(event){
    let new_device_form = get_active_new_device_form(event);
    $(new_device_form).remove();
}

function show_device_edit_form(event){
    let active_device_log = get_active_device_log(event);
    let device_data = get_device_log_data(active_device_log);
    
    let device_edit_form = generate_device_form();
    let handlers = {
        ok: update_device,
        cancel: cancel_update_device
    }
    device_edit_form = bind_device_edit_form_handlers(device_edit_form, handlers);
    device_edit_form = fill_form_with_data(device_edit_form, device_data);
    $(active_device_log).replaceWith($(device_edit_form));
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
                $(active_device_edit_form).replaceWith($(updated_device_log));
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
                $(active_device_edit_form).replaceWith($(old_device_log));
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