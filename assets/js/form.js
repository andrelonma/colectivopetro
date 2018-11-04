$(document).ready(function(){
    $('#add').on('click', function(e){
        e.preventDefault();
        year = $('#ano').val();
        ventas = $('#ventas').val();
        emp = $('#emp').val();
        $('#year-list').append(`
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                <h6 class="my-0">${year}</h6>
                </div>
                <span class="text-muted">${ventas}</span>

                <span class="text-muted">${emp}</span>
            </li>
        `)
        $('#ano').val('');
        $('#ventas').val('');
        $('#emp').val('');
    })
})