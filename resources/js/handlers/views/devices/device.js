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
    event.preventDefault();
    let new_movement_log_form = event.target;
    let input_data = get_form_data($(new_movement_log_form));
    add_movement_log_to_db(input_data)
    .done((new_movement_log) => {
        let table = $(new_movement_log_form).parents('.table').first();
        $(table).find('.new-form').last().after(new_movement_log);
        $(new_movement_log_form).parents('.table-row').first().remove();
    });
}

function cancel_add_new_entry(event){
    event.preventDefault();
    let form = event.target;
    let form_table_row = $(form).closest('.table-row');
    $(form_table_row).remove();
}

function cancel_update_device(event){
    event.preventDefault();
    let active_form = event.target;
    let device_id = get_form_data($(active_form)).id;
    get_device_log_view(device_id)
    .done(old_entry_table_row => {
        let active_form_table_row = $(active_form).closest('.table-row');
        $(active_form_table_row).replaceWith(old_entry_table_row);
    })
}

function cancel_update_device_comment(event){
    event.preventDefault();
    let active_form = event.target;
    let device_id = get_form_data($(active_form)).device_id;

    get_device_comment_log_view(device_id)
    .done(old_device_comment_log_view => {
        let destination = get_active_table_row(active_form).find('.section.comment').find('.content');
        $(destination).empty();
        $(destination).append(old_device_comment_log_view);
    })
}

function cancel_update_movement_log(event){
    event.preventDefault();
    let active_form = event.target;
    let movement_log_id = get_form_data($(active_form)).id;
    get_movement_log_view(movement_log_id)
    .done(old_entry_table_row => {
        let active_form_table_row = $(active_form).closest('.table-row');
        $(active_form_table_row).replaceWith(old_entry_table_row);
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

function delete_device(activated_btn){
    let device_id = $(activated_btn).val();
    delete_device_from_db(device_id)
    .done(() => {
        get_active_table_row(activated_btn)
            .remove();
    })
}

function delete_movement_log(delete_btn){
    let movement_log_id = $(delete_btn).val();
    delete_movement_log_from_db(movement_log_id)
    .done((isDeleted) => {
        if(isDeleted){
            get_active_table_row(delete_btn).remove();
        }
    })
}

function find_devices(event){
    event.preventDefault();
    let input = $('input#search-keywords');
    let input_string = $(input).val();
    $('#search-status').text('Йде пошук...');
    find_devices_in_db(input_string)
    .done(data => {
        $('#search-status').empty();
        $('#device-table-container').html(data);
    });
}

function hide_device_log_control(event){
    let active_table_row = event.currentTarget;
    let control_cell = $(active_table_row).find('div[name="control"]').children().attr('hidden', 'hidden');
}

function hide_device_more_info(event){
    let activated_btn = event.currentTarget;
    let active_device_log = get_active_table_row(activated_btn);
    
    // animate an addition info block collapsing
    let main_info_block = $(active_device_log).find('.main-info');
    let additional_info_block = $(active_device_log).find('.additional-info');

    $(active_device_log).animate({
        height: $(main_info_block).outerHeight()
    }, 500, function(){
        $(additional_info_block).remove();
    });

    let btn_more = event.currentTarget;
    $(btn_more).attr('onclick', 'show_device_more_info(this)');
}

function show_characteristics_edit_form(){
}

function show_device_log_control(event){
    let active_table_row = event.currentTarget;
    let control_cell = $(active_table_row).find('div[name="control"]').children().removeAttr('hidden');
}

function show_device_edit_form(activated_btn){
    let device_id = $(activated_btn).val();
    get_device_form_view(device_id)
    .done(device_edit_form_table_row => {
        get_active_table_row(activated_btn)
            .replaceWith(device_edit_form_table_row);
    })
}

function show_device_more_info(activated_btn){
    let device_id = $(activated_btn).val();
    get_device_more_info_view(device_id)
    .done(device_additional_info_view => {
        let active_table_row = get_active_table_row(activated_btn);
        $(active_table_row).children('.table-row-content').append(device_additional_info_view);

        // animate an addition info block expanding
        let main_info_block = $(active_table_row).find('.main-info');
        let additional_info_block = $(active_table_row).find('.additional-info');

        $(active_table_row).height($(main_info_block).outerHeight());
        $(active_table_row).animate({
            height: $(main_info_block).outerHeight() + $(additional_info_block).outerHeight()
        }, 500, function(){
            $(active_table_row).height('auto');
        });
    });

    let btn_more = event.currentTarget;
    $(btn_more).attr('onclick', 'hide_device_more_info(event)');
}

function show_movement_log_edit_form(activated_btn){
    let movement_log_id = $(activated_btn).val();

    get_movement_log_form_view({log_id: movement_log_id})
    .done(movement_log_edit_form_table_row => {
        get_active_table_row(activated_btn)
            .replaceWith(movement_log_edit_form_table_row);
    })
}

function show_new_device_form(){
    get_device_form_view()
    .done(new_device_form_table_row => {
        $('#device-table').find('[name="body"]').first().prepend(new_device_form_table_row);
    })
}

function show_new_movement_log_form(activated_btn){
    let active_table_row = get_active_table_row(activated_btn);
    let active_movement_history_table = $(active_table_row).find('.movement-history-table');
    let device_id = $(activated_btn).val();
    
    get_movement_log_form_view({unit_id: device_id})
    .done(new_movement_log_form_view => {
        $(active_movement_history_table).find('[name="body"]').prepend(new_movement_log_form_view);
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
    let active_form = event.target;
    let input_data = get_form_data($(active_form));
    update_device_in_db(input_data)
    .done(updated_entry_table_row => {
        get_active_table_row(active_form)
            .replaceWith(updated_entry_table_row);
    });
}

function update_device_comment(event){
    event.preventDefault();
    let active_form = event.target;
    let send_data = get_form_data($(active_form));

    update_device_comment_in_db(send_data)
    .done(updated_entry_table_row => {
        let comment_content_wrapper = get_active_table_row(active_form).find('.section.comment').find('.content');
        $(comment_content_wrapper).empty();
        $(comment_content_wrapper).append(updated_entry_table_row);
    });
}

function update_movement_log(event){
    event.preventDefault();
    let active_form = event.target;
    let input_data = get_form_data($(active_form));

    update_movement_log_in_db(input_data)
    .done(updated_entry_table_row => {
        get_active_table_row(active_form)
            .replaceWith(updated_entry_table_row);
    });
}