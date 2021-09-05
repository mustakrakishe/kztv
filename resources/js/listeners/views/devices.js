$(document).on('click', '.pagination a', function(event){
    event.preventDefault(); 
    let parameters = {
        page: $(this).attr('href').split('page=')[1],
        filters: { search_string: $('input#search-keywords').val() }
    };

    fetch_data(parameters)
    .done(data => {
        $('#device-table-container').html(data);
    });
});
  
function fetch_data(data){
    return $.get({
        url: "/devices/fetch_data",
        data: data
    });
}