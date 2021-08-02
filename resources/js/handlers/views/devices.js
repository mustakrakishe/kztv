// при добавлении нового устройства он не добавляется в таблицу
function show_new_device_form(){
    $('table#device_table').children('tbody').prepend($(table_rows.new_device_form));  // table_rows from the Devices view
}

    function add_new_device(event){
        let new_device_form = get_active_new_device_form(event);
        let input_data = get_form_data(new_device_form);
        add_device_to_db(input_data)
        .done((new_device) => {
            new_device = JSON.parse(new_device);
            let new_device_log = generate_device_log(new_device);
            let table_last_log = $('table#device_table').children('tbody').children('.device-log:first');
                if(table_last_log.length){
                    $(table_last_log).before($(new_device_log));
                }
                else{
                    $('table#device_table').children('tbody').append($(new_device_log));
                }
                $(new_device_form).remove();
        });
    }

function cancel_add_new_device(event){
    let new_device_form = get_active_new_device_form(event);
    $(new_device_form).remove();
}

function show_device_edit_form(event){
    let active_device_log = get_active_device_log(event);
    let device = get_device_log_data(active_device_log);
    let device_edit_form = generate_edit_device_form(device);
    device_edit_form = save_form_old_data(device_edit_form);
    $(active_device_log).replaceWith($(device_edit_form));
}

function update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let input_data = get_form_data(active_device_edit_form);
    update_device_in_db(input_data)
    .done((updated_device) => {
        updated_device = JSON.parse(updated_device);
        let updated_device_log = generate_device_log(updated_device);
        $(active_device_edit_form).replaceWith($(updated_device_log));
    });
}

function cancel_update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let device_old = get_form_old_data(active_device_edit_form);
    let device_old_log = generate_device_log(device_old);
    $(active_device_edit_form).replaceWith($(device_old_log));
}

function delete_device(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    delete_device_from_db(device_id)
        .done(() => {
            $(active_device_log).remove();
        })
}