// table_row_form = set_form_btn_handlers($(table_row_form)); // table_row_form from the Devices view

$('button#new_device').on('click', show_new_device_form);

$('table#device_table').find('button.edit').on('click', show_device_edit_form);
$('table#device_table').find('button.delete').on('click', delete_device);