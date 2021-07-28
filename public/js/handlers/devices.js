
table_row_form = set_form_btn_handlers($(table_row_form)); // table_row_form from the Devices view

$('button#new_device').on('click', insert_new_device_form);

$('button.edit_device').on('click', function(){
    let active_row = $(this).parents().eq(3);
    convert_to_form($(active_row));
});

$('.del_device').on('click', delete_device);

$('.cancel_upd_device').on('click', function(){
    // Изменить, чтоб возвращались данные из бд
    let active_row = $(this).parents().eq(3);

    let device_propertie_cells = $(active_row).children('.info');
    let device_ctrl_cell = $(active_row).children('.ctrl');

    $(device_propertie_cells).each((index, cell) => {
        let prop_val = $(cell).children().val().trim();

        $(cell).empty();
        $(cell).append(prop_val);
    })
    
    $(device_ctrl_cell).children('.read-mode').attr('hidden', false);
    $(device_ctrl_cell).children('.edit-mode').attr('hidden', true);
})

$('.upd_device').on('click', function(){
    let active_row = $(this).parents().eq(3);

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
})