$(document).ready(function(){
    $.ajax('../php/sedes_list.php')
        .done(function(callback) {
        $.each(callback, function(key, value){
            let element = JSON.parse(value)
            $("#emp").append("<option value='"+element.id+"'>"+element.nombre+"</option>")
        })
    })
    
    $('#add').on('click', function(e){
        e.preventDefault();

        year = new Date($('#ano').val());
        ventas = $('#ventas').val();
        emp = $('#emp').val();

        $('#year-list').append(`
            <li class="list-group-item d-flex justify-content-between lh-condensed">
                <div>
                <h6 class="my-0">${year.getFullYear()}</h6>
                </div>
                <span class="text-muted">${ventas}</span>

                <span class="text-muted">${emp}</span>
            </li>
        `)
        let data = {
            year: year.getFullYear(),
            value: ventas,
            emp: emp
        }
        //alert(`../php/apeend_ventas.php?year=${data.year}&value=${data.value}&emp=${data.emp}`);
        $.ajax({
            type: "GET",
            url: `../php/apeend_ventas.php?year=${data.year}&value=${data.value}&emp=${data.emp}`
        })
        .done(function(callback) {
            //alert(callback);
        })
        .fail(function(data){
            //if(data.responseCode)
            alert("fail:" + data.responseCode);
        }
        )
        .always(function(){
            //alert("Always");
        }
        )
        ;

        $('#ano').val('');
        $('#ventas').val('');
        $('#emp').val('');
    })

    $('#sennd').on('click', function(event){
        event.preventDefault()
        window.location.href = './result.php'
    })
})