function add_new_device_form(destination){
    $(destination).prepend(table_row_form);
}

function get_device_row_data(active_row){
    let device = {
        id: $(active_row).attr('id')
    };

    let device_propertie_cells = $(active_row).children('.info');

    $(device_propertie_cells).each((index, cell) => {
        let prop_name = $(cell).attr('name');
        let prop_val = $(cell).children().val().trim();

        device[prop_name] = prop_val;
    })
}

function add_new_device(){
    let device = get_device_data();
}


function convert_to_form(active_row){

    let device_propertie_cells = $(active_row).children('.info');
    let device_ctrl_cell = $(active_row).children('.ctrl');

    $(device_propertie_cells).each((index, cell) => {
        let prop_val = $(cell).text().trim();

        $(cell).empty();
        $(cell).append('<input type="text" class="form-control" value="' + prop_val + '">');
    })
    
    $(device_ctrl_cell).children('.read-mode').attr('hidden', true);
    $(device_ctrl_cell).children('.edit-mode').attr('hidden', false);
}

function delete_device(){
    let device_id = $(this).val();
    
    $.ajax(
        {
            url: del_device_handler_link,
            data: {'device_id': device_id}
        }
    ).done((result) => {
        $(this).parents().eq(3).remove();
    })
}