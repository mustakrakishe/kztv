function add_new_device(event){
    event.preventDefault();
    let new_device_form = event.target;
    let new_device_input_data = get_form_data($(new_device_form));
    add_device_to_db(new_device_input_data)
    .done((log_new_entry) => {
        $('#device-table').find('.new-device-form').last().after(log_new_entry);
        let new_device_form_table_row = $(new_device_form).parents('.table-row');
        $(new_device_form_table_row).remove();
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
    event.preventDefault();
    let new_device_form = event.target;
    let new_device_form_table_row = $(new_device_form).parents('.table-row');
    $(new_device_form_table_row).remove();
}

function cancel_add_new_movement_log(event){
    let new_movement_log_form = get_active_new_movement_log_form(event);
    $(new_movement_log_form).remove();
}

function cancel_update_device(event){
    event.preventDefault();
    let active_device_edit_form = event.target;
    let device_id = get_form_data($(active_device_edit_form)).id;
    get_device_log_view(device_id)
    .done(log_old_entry_table_row => {
        let device_edit_form_table_row = $(active_device_edit_form).parents('.table-row');
        $(device_edit_form_table_row).replaceWith(log_old_entry_table_row);
    })
}

function cancel_update_device_comment(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data(active_device_log).id;
    get_device_comment_log_view(device_id)
    .done(old_device_comment_log_view => {
        let destination = $(active_device_log).find('.section.comment').find('.content');
        $(destination).empty();
        $(destination).append(old_device_comment_log_view);
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
    let selected_option = $(select).children('option:selected');
    if(selected_option.val() == 'new'){
        $(selected_option).attr('disabled', 'disabled');
        let new_type_input = '<input type="text" name="type" class="form-control" placeholder="Тип"></input>';
        $(select).after(new_type_input);
    }
    else{
        $(select).siblings('input').remove();
        $(select).children('option[value="new"]').removeAttr('disabled');
    }
}

function delete_device(event){
    let active_table_row = get_active_device_log(event);
    let device_id = get_device_log_data($(active_table_row)).id;
    delete_device_from_db(device_id)
    .done(() => {
        $(active_table_row).remove();
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

function find_devices(event){
    event.preventDefault();
    let input = $('input#search-keywords');
    let input_string = $(input).val();
    $('#search-status').text('Йде пошук...');
    find_devices_in_db(input_string)
    .done(device_logs => {
        $('#search-status').empty();
        let destination = $('#device-table').find('div[name="body"]').first();
        $(destination).empty();
        device_logs.forEach(function(log){
            $(destination).append(log);
        })
    })
}

function hide_device_log_control(event){
    let active_table_row = event.currentTarget;
    let control_cell = $(active_table_row).find('.cell[name="control"]').children().attr('hidden', 'hidden');
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

function show_device_comment_edit_form(event){
    let active_device_log = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log)).id;
    get_device_comment_form(device_id)
    .done(device_comment_edit_form => {
        let destination = $(active_device_log).find('.section.comment').find('.content');
        $(destination).empty();
        $(destination).append(device_comment_edit_form);
    })
}

function show_device_log_control(event){
    let active_table_row = event.currentTarget;
    let control_cell = $(active_table_row).find('.cell[name="control"]').children().removeAttr('hidden');
}

function show_device_edit_form(event){
    let active_device_log_table_row = get_active_device_log(event);
    let device_id = get_device_log_data($(active_device_log_table_row)).id;
    get_device_form(device_id)
    .done(device_edit_form_table_row => {
        $(active_device_log_table_row).replaceWith(device_edit_form_table_row);
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
    .done(new_device_form_table_row => {
        $('#device-table').find('[name="body"]').first().prepend(new_device_form_table_row);
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

function switch_tabs(event){
    let tab_group_name = $(event.target).attr('name');
    let activated_tab_name = $(event.target).attr('value');
    $('.' + tab_group_name).attr('hidden', 'hidden');
    $('#' + activated_tab_name).removeAttr('hidden');

}

function update_device(event){
    event.preventDefault();
    let active_device_edit_form = event.target;
    let input_data = get_form_data($(active_device_edit_form));
    update_device_in_db(input_data)
    .done(new_table_row => {
        let active_table_row = $(active_device_edit_form).parents('.table-row');
        $(active_table_row).replaceWith(new_table_row);
    });
}

function update_device_comment(event){
    let active_device_log = get_active_device_log(event);
    let comment_form = $(active_device_log).find('.additional-info').find('.section.comment').find('.content');
    let send_data = get_form_data(comment_form);
    send_data.device_id = get_device_log_data(active_device_log).id;
    update_device_comment_in_db(send_data)
    .done(updated_device_comment_view => {
        let destination = $(active_device_log).find('.section.comment').find('.content');
        $(destination).empty();
        $(destination).append(updated_device_comment_view);
    });
}

function update_movement_log(event){
    let active_movement_log_edit_form = get_active_movement_log_edit_form(event);
    let input_data = get_form_data(active_movement_log_edit_form);
    update_movement_log_in_db(input_data)
    .done(updated_movement_log => {
        $(active_movement_log_edit_form).replaceWith(updated_movement_log);
    });
}