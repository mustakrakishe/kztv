function set_form_btn_handlers(row){
    let btn_add_device = $(row).find('button.add_device');
    let btn_cancel_add_device = $(row).find('button.cancel_add_device');
    $(btn_cancel_add_device).on('click', remove_new_device_form);
    $(btn_add_device).on('click', add_new_device);
    return $(row);
}

    function remove_new_device_form(event){
        let activated_btn = event.currentTarget;
        let active_row = $(activated_btn).parents().eq(4);
        $(active_row).remove();
    }
    
    function add_new_device(event){
        let input_data = get_input_data(event);
        let data_to_send = {
            token: input_data._token,
            device: {}
        };

        for(let key in input_data){
            if(key != '_token'){
                data_to_send.device[key] = input_data[key];
            }
        };

        send_data(add_device_handler_link, data_to_send)
            .done(function(result){
                remove_new_device_form(event)
                let new_device_log = JSON.parse(result);
                show_new_device(new_device_log);
            });
    }

        function get_input_data(event){
            let activated_btn = event.currentTarget;
            let active_row = $(activated_btn).parents().eq(4);

            let input_data = get_table_row_form_data(active_row);
            return input_data;
        }

            function get_table_row_form_data(row){
                let inputs = $(row).find('input');
                let table_row_form_data = {};
                $(inputs).each((index, input) => {
                    let name = $(input).attr('name');
                    let value = $(input).val();
                    table_row_form_data[name] = value;
                });
                return table_row_form_data;
            }
        
        function send_data(url, data){
            return $.ajax({
                url: url,
                data: data
            });
        }

        function show_new_device(new_device){
            insert_table_row_device(new_device);
            let table = $('#device_table');
            $(table).children('tbody').prepend(new_device);
        }

            function insert_table_row_device(device){
                let table = $('#device_table');
                let new_table_row_device = $(table_row_form_device).clone(true, true);
                $(table).children('tbody').prepend($(new_table_row_device));
            }

function insert_new_device_form(){
    insert_table_row_form();
}

    function insert_table_row_form(){
        let table = $('#device_table');
        let new_table_row_form = $(table_row_form).clone(true, true);
        $(table).children('tbody').prepend($(new_table_row_form));
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