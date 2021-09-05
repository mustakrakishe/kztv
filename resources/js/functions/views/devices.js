function add_device_to_db(input_data){
    return $.post({
        url: links.add_device, // links from the Devices view
        data: input_data
    });
}

function add_movement_log_to_db(input_data){
    return $.post({
        url: links.add_movement_log, // links from the Devices view
        data: input_data
    });
}

function delete_device_from_db(device_id){
    return $.ajax({
        url: links.delete_device, // links from the Devices view
        data: {id: device_id}
    });
}

function delete_movement_log_from_db(log_id){
    return $.ajax({
        url: links.delete_movement_log, // links from the Devices view
        data: {id: log_id}
    });
}

function find_devices_in_db(search_string){
    return $.ajax({
        url: links.find_devices, // links from the Devices view
        data: {filters: {
            search_string: search_string
        }}
    });
}

function get_active_table_row(table_row_component){
    let active_table_row = $(table_row_component).closest('.table-row');
    return active_table_row;
}

function get_device_proprty_form_view(device_id, property_name){
    return $.get({
        url: links.get_device_property_edit_form, // links from the Devices view
        data: {
            device_id: device_id,
            property_name: property_name
        }
    });
}

function get_device_comment_log_view(device_id){
    return $.ajax({
        url: links.get_device_comment_log_view, // links from the Devices view
        data: {device_id: device_id}
    });
}

function get_device_form_view(device_id = null){
    return $.ajax({
        url: links.get_device_form_view, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_log_view(device_id){
    return $.ajax({
        url: links.get_device_log_view, // links from the Devices view
        data: {id: device_id}
    });
}

function get_device_more_info_view(device_id){
    return $.ajax({
        url: links.get_device_more_info_view, // links from the Devices view
        data: {id: device_id}
    });
}

function get_form_data(form){
    let key_value_pairs = form.serializeArray();
    let form_data = Object.fromEntries(key_value_pairs.map(field => {
        return [field.name, field.value];
    }));

    return form_data;
}

function get_movement_log_view(log_id){
    return $.ajax({
        url: links.get_movement_log_view, // links from the Devices view
        data: {id: log_id}
    });
}

function get_movement_log_form_view(send_data){
    return $.ajax({
        url: links.get_movement_log_form_view, // links from the Devices view
        data: send_data
    });
}

function update_device_in_db(device){
    return $.ajax({
        url: links.update_device, // links from the Devices view
        data: device
    })
}

function update_device_comment_in_db(send_data){
    return $.ajax({
        url: links.update_device_comment, // links from the Devices view
        data: send_data
    })
}

function update_movement_log_in_db(log){
    return $.ajax({
        url: links.update_movement_log, // links from the Devices view
        data: log
    })
}