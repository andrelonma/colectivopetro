<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Formulario</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="../assets/css/form-validation.css" rel="stylesheet">
    <link href="../assets/css/result.css" rel="stylesheet">
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js" ></script>
    <script src="../assets/js/popper.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script>
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    let list = []
    let data = {}

    $.ajax('../php/chart_api.php')
    .done(function(callback) {
      list.push(['Año', 'Ventas'])
      data = callback
      $.each(callback, function(key, value){
        let item = JSON.parse(value)
        if (item.ano != "" && item.valor != ''){
          list.push([parseInt(item.ano), parseInt(item.valor)])
        }
      })
    })

    let city_keys = []
    city_keys.push({nombre: 'Año', id: 'x'})
    $.ajax('../php/sedes_list.php')
        .done(function(callback) {
        $.each(callback, function(key, value){
          let item = JSON.parse(value)
          city_keys.push(item)
        })
    })

    setTimeout(() => {
      $.each(city_keys, function(key, value){
        $('#keys').append(`<th scope="col">${value.nombre}</th>`)
      })

      let data_result = []
      let aready_user_year = []
      $.each(data ,function(key_first, value_first){
        let self = {}
        let first_item = JSON.parse(value_first)
        let valid = true           
        
        $.each(aready_user_year, function(key, value){
          if (value == first_item.ano){
            valid = false
          }
        })
        
        if (valid && first_item.ano != ''){
          self['ano'] = first_item.ano
          self[city_keys[Number(first_item.id_sede)+1].nombre] = first_item.valor
          
          $.each(data ,function(key_second, value_second){
            let second_item = JSON.parse(value_second)
            
            if (first_item.ano == second_item.ano){
              self[city_keys[Number(second_item.id_sede)+1].nombre] = second_item.valor
            }
          })
          
          aready_user_year.push(first_item.ano)
          data_result.push(self)
        }


      })

      let html = ''
      $.each(data_result, function(key_data, value_date){
        let html_content = '<tr>'
        $.each(Object.keys(value_date), function(key_item, value_item){

          let keys_empty = []
          $.each(city_keys, function(key, value){
            if (key > key_item){
              keys_empty.push(value)
              return false;
            }
          })

          $.each(keys_empty, function(key, value){
            if (value.nombre == 'Año'){
              value.nombre = 'ano'
            }
            if (value_item == value.nombre){
              return false;
            }else{
              html_content += `<th></th>`
            }
          })

          if (key_item == 0){
            html_content += `<th scope="row">${value_date[value_item]}</th>`
          }else{
            html_content += `<th>${value_date[value_item]}</th>`
          }
        })
        html_content += '</tr>'
        html+=html_content
      })

      $('#body_table').html(html)
    }, 1000);

    function drawChart(){
        setTimeout(() => {
            var data = google.visualization.arrayToDataTable(list);
            var options = {
                title: 'Grafico de dispersion de ventas por año',
                hAxis: {title: 'Año'},
                vAxis: {title: 'Ventas'},
                legend: 'none'
            };
            
            var chart = new google.visualization.ScatterChart(document.getElementById('chart_div'));
            
            chart.draw(data, options);
        }, 1000);
    }
  </script>
  </head>

  <body class="bg-light">

    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="http://www.ucp.edu.co/portal/wp-content/themes/UCatolica/images/logo.png" alt="">
        <h2>Resultado</h2>
        <p class="lead">A continuacion se mostrara el resultado grafico.</p>
      </div>
      <div class="row">
            <div id="chart_div" style="width: 900px; height: 500px;"></div>
      </div>
      <div class="row">
        <table class="table table-dark">
          <thead>
            <tr id='keys'>
              <th></th>
            </tr>
          </thead>
          <tbody id='body_table'>
          </tbody>
        </table>
      </div>
      <div class="row mt-3"> 
        <h2>Pereira</h2>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Dato estadistico</th>
              <th scope="col">Resultado</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">Rango</th>
              <td>9</td>

            </tr>
            <tr>
              <th scope="row">Media</th>
              <td>23</td>
            
            </tr>
            <tr>
              <th scope="row">Desviacion tipica</th>
              <td>56</td>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="row mt-3">
          <h2>Bogota</h2>
          <table class="table">
            <thead>
              <tr>
                <th scope="col">Dato estadistico</th>
                <th scope="col">Resultado</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <th scope="row">Rango</th>
                <td>9</td>
  
              </tr>
              <tr>
                <th scope="row">Media</th>
                <td>23</td>
              
              </tr>
              <tr>
                <th scope="row">Desviacion tipica</th>
                <td>56</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="row mt-3">
            <h2>Manizales</h2>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">Dato estadistico</th>
                  <th scope="col">Resultado</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">Rango</th>
                  <td>9</td>
    
                </tr>
                <tr>
                  <th scope="row">Media</th>
                  <td>23</td>
                
                </tr>
                <tr>
                  <th scope="row">Desviacion tipica</th>
                  <td>56</td>
                </tr>
              </tbody>
            </table>
          </div>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; Andrea</p>
      </footer>
    </div>

  </body>
</html>