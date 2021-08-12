function add_new_device(event){
    let new_device_form = get_active_new_device_form(event);
    let input_data = get_device_form_data(new_device_form);
    add_device_to_db(input_data)
    .done((new_device_log) => {
        $('#device-table').find('.new-device-form').last().after(new_device_log);
        $(new_device_form).remove();
    });
}

function add_new_movement_log(event){
    let new_movement_log_form = get_active_new_movement_log_form(event);
    let input_data = get_movement_log_form_data(new_movement_log_form);
    add_movement_log_to_db(input_data)
    .done((new_movement_log) => {
        $(new_movement_log_form).parent().children('.new-form').last().after(new_movement_log);
        $(new_movement_log_form).remove();
    });
}

function cancel_add_new_device(event){
    let new_device_form = get_active_new_device_form(event);
    $(new_device_form).remove();
}

function cancel_add_new_movement_log(event){
    let new_movement_log_form = get_active_new_movement_log_form(event);
    $(new_movement_log_form).remove();
}

function cancel_update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let device_id = get_device_form_data(active_device_edit_form).id;
    get_device_log(device_id)
    .done(old_device_log => {
        $(active_device_edit_form).replaceWith(old_device_log);
    })
}

function cancel_update_movement_log(event){
    let active_movement_log_form = get_active_movement_log_edit_form(event);
    let movement_log_id = get_movement_log_form_data(active_movement_log_form).id;
    get_movement_log_view(movement_log_id)
    .done(old_movement_log => {
        $(active_movement_log_form).replaceWith(old_movement_log);
    })
}

function check_type(event){
    let select = event.target;
    let selected_type = $(select).children('option:selected').val();
    if(selected_type == 'new'){
        let new_type_input = '<input type="text" name="type" class="form-control" placeholder="Тип"></input>';
        $(select).after(new_type_input);
    }
    else{
        $(select).siblings('input').remove();
    }
}

function delete_device(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    delete_device_from_db(device_id)
    .done(() => {
        $(active_device_log).remove();
    })
}

function delete_movement_log(event){
    let active_movement_log = get_active_movement_log(event);
    let movement_log_id = get_movement_log_data($(active_movement_log)).id;
    delete_movement_log_from_db(movement_log_id)
    .done(() => {
        $(active_movement_log).remove();
    })
}

function hide_device_more_info(event){
    let active_device_log = get_active_device_log(event);
    
    // animate an addition info block collapsing
    let main_info_block = $(active_device_log).find('.main-info');
    let additional_info_block = $(active_device_log).find('.additional-info');

    $(active_device_log).animate({
        height: $(main_info_block).outerHeight()
    }, 500, function(){
        $(additional_info_block).remove();
    });

    let btn_more = event.currentTarget;
    $(btn_more).attr('onclick', 'show_device_more_info(event)');
}

function show_device_edit_form(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    get_device_form(device_id)
    .done(device_edit_form => {
        $(active_device_log).replaceWith(device_edit_form);
    })
}

function show_device_more_info(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    get_device_more_info(device_id)
    .done(device_additional_info => {
        $(active_device_log).children('.table-row-content').append(device_additional_info);

        // animate an addition info block expanding
        let main_info_block = $(active_device_log).find('.main-info');
        let additional_info_block = $(active_device_log).find('.additional-info');

        $(active_device_log).height($(main_info_block).outerHeight());
        $(active_device_log).animate({
            height: $(main_info_block).outerHeight() + $(additional_info_block).outerHeight()
        }, 500, function(){
            $(active_device_log).height('auto');
        });
    });

    let btn_more = event.currentTarget;
    $(btn_more).attr('onclick', 'hide_device_more_info(event)');
}

function show_movement_log_edit_form(event){
    let active_movement_log_log = get_active_movement_log(event);
    let movement_log_id = get_movement_log_data($(active_movement_log_log)).id;
    get_movement_log_form({log_id: movement_log_id})
    .done(movement_log_edit_form => {
        $(active_movement_log_log).replaceWith(movement_log_edit_form);
    })
}

function show_new_device_form(){
    get_device_form()
    .done(new_device_form => {
        $('#device-table').find('[name="body"]').first().prepend(new_device_form);
    })
}

function show_new_movement_log_form(event){
    let active_movement_history_table = get_active_movement_history_table(event);
    let active_device_log = $(active_movement_history_table).parents().eq(6);
    let device_id = get_device_log_data($(active_device_log)).id;
    get_movement_log_form({unit_id: device_id})
    .done(new_movement_log_form => {
        $(active_movement_history_table).find('[name="body"]').prepend(new_movement_log_form);
    })
}

function update_device(event){
    let active_device_edit_form = get_active_device_edit_form(event);
    let input_data = get_device_form_data(active_device_edit_form);
    update_device_in_db(input_data)
    .done(updated_device_log => {
        $(active_device_edit_form).replaceWith(updated_device_log);
    });
}

function update_movement_log(event){
    let active_movement_log_edit_form = get_active_movement_log_edit_form(event);
    let input_data = get_movement_log_form_data(active_movement_log_edit_form);
    update_movement_log_in_db(input_data)
    .done(updated_movement_log => {
        $(active_movement_log_edit_form).replaceWith(updated_movement_log);
    });
}