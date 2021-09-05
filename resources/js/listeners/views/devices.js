$(document).on('click', '.pagination a', function(event){
    event.preventDefault(); 
    var page = $(this).attr('href').split('page=')[1];
    fetch_data(page)
    .done(data => {
        $('#device-table-container').html(data);
    });
});
  
function fetch_data(page){
    return $.ajax({
        url: "/devices/fetch_data?page=" + page
    })
}