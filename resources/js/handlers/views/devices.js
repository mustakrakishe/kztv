function insert_new_device_form(){
    insert_table_row_form();
}

function convert_table_row_device_to_form(event){
    let activated_btn = event.currentTarget;
    let active_row = $(activated_btn).parents().eq(3);
    convert_to_form($(active_row));
}

function cancel_update_device(event){
    // Изменить, чтоб возвращались данные из бд
    let activated_btn = event.currentTarget;
    let active_row = $(activated_btn).parents().eq(3);

    let device_propertie_cells = $(active_row).children('.info');
    let device_ctrl_cell = $(active_row).children('.ctrl');

    $(device_propertie_cells).each((index, cell) => {
        let prop_val = $(cell).children().val().trim();

        $(cell).empty();
        $(cell).append(prop_val);
    })
    
    $(device_ctrl_cell).children('.read-mode').attr('hidden', false);
    $(device_ctrl_cell).children('.edit-mode').attr('hidden', true);
}

function delete_device(event){
    let activated_btn = event.currentTarget;
    let device_id = $(activated_btn).val();
    
    $.ajax(
        {
            url: del_device_handler_link,
            data: {'device_id': device_id}
        }
    ).done((result) => {
        $(this).parents().eq(3).remove();
    })
}

function update_device(event){
    let activated_btn = event.currentTarget;
    let active_row = $(activated_btn).parents().eq(3);

    let device = {
        id: $(this).val()
    };

    let device_propertie_cells = $(active_row).children('.info');

    $(device_propertie_cells).each((index, cell) => {
        let prop_name = $(cell).attr('name');
        let prop_val = $(cell).children().val().trim();

        device[prop_name] = prop_val;
    })

    $.ajax(
        {
            url: upd_device_handler_link,
            data: {'device': device}
        }
    ).done((response) => {
        console.log(response);

        $(device_propertie_cells).each((index, cell) => {
            let prop_val = $(cell).children().val().trim();

            $(cell).empty();
            $(cell).append(prop_val);
        })
        
        let device_ctrl_cell = $(active_row).children('.ctrl');
        $(device_ctrl_cell).children('.read-mode').attr('hidden', false);
        $(device_ctrl_cell).children('.edit-mode').attr('hidden', true);
    })
}