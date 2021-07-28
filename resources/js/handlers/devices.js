table_row_form = set_form_btn_handlers($(table_row_form)); // table_row_form from the Devices view

$('button#new_device').on('click', insert_new_device_form);

$('button.edit_device').on('click', convert_table_row_device_to_form);

$('.del_device').on('click', delete_device);

$('.cancel_upd_device').on('click', cancel_update_device);

$('.upd_device').on('click', update_device)