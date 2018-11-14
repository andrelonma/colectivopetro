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

    // consumiendo datos de la api para la grafica ººº trallendo los datos de las ventas
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

    //consumiendo la api de las sedes ººº para poder listar los datos de los contenidos 
    let city_keys = []
    //city_keys.push({nombre: 'Año', id: 'x'})
    $.ajax('../php/sedes_list.php')
        .done(function(callback) {
        $.each(callback, function(key, value){
          let item = JSON.parse(value)
          city_keys.push(item)
        })
    })

    setTimeout(() => {
      // recorriendo las llavas que se trajeron de la api
      /* $.each(city_keys, function(key, value){
        $('#keys').append(`<th scope="col">${value.nombre}</th>`)
      })

      let data_result = []
      let aready_user_year = []
      // recorriendo los elementos de la api que contiene los valores  en la base de datos de llaman registros
      $.each(data ,function(key_first, value_first){
        let self = {}
        let first_item = JSON.parse(value_first)
        let valid = true           
        
        // para no tener que repetir llaves entonces se almacenan las que ya estan usadas en una lista
        $.each(aready_user_year, function(key, value){
          if (value == first_item.ano){
            valid = false
          }
        })
        
        if (valid && first_item.ano != ''){
          // se añaden los datos a un objeto para poder recorrerlo 
          self['ano'] = first_item.ano
          self[city_keys[Number(first_item.id_sede)+1].nombre] = first_item.valor
          
          $.each(data ,function(key_second, value_second){
            let second_item = JSON.parse(value_second)
            // se valida que el año sea el mismo para poder identificar si este valor se puede adjuanta para tener un valor que sea mas vertical
            if (first_item.ano == second_item.ano){
              self[city_keys[Number(second_item.id_sede)+1].nombre] = second_item.valor
            }
          })
          
          aready_user_year.push(first_item.ano)
          data_result.push(self)
        }


      }) */

      /* let html = ''
      // se recorren los datos de las consultas para poder mostrar las tablas de los datos
      $.each(data_result, function(key_data, value_date){
        let html_content = '<tr>'
        // se recorren cada una de las llaves que tenga el objeto para poder obtener el contenido de forma vertical
        $.each(Object.keys(value_date), function(key_item, value_item){

          let keys_empty = []
          // se utilisa este ciclo para poder limpiar los valor que sean mayores que el que inicia
          $.each(city_keys, function(key, value){
            if (key => key_item){
              keys_empty.push(value)
              return false;
            }
          })
          
          // se recorren los valores para poder añadir espacios iniciales como tabulacion
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

          console.log(html_content)

          // si la llave es igual a 0 significa que es a inicial entonce se procede a añadir un atributo adicional
          if (key_item == 0){
            html_content += `<th scope="row">${value_date[value_item]}</th>`
          }else{
            html_content += `<th>${value_date[value_item]}</th>`
          }
        })
        html_content += '</tr>'
        html+=html_content
      })

      // este es el que añade el html de a tabla
      $('#body_table').html(html) */
      

      $.each(data, function(key, value){
        let item = JSON.parse(value)
        let city = ''
        $.each(city_keys, function(key, value){
          if (key == item.id_sede){
            city = value.nombre
            return false
          }
        })
        $('#body_table').append(`
        <tr>
          <th>
            ${item.ano}
          </th>
          <th>
            ${city}
          </th>
          <th>
            ${item.valor}
          </th>
        </tr>
        `)
      })

      // se recorren cada un de las llaves de la ciudades para realizar calculos por ciudad
      $.each(city_keys, function(key_id, value_id){
        let calc_element = {
          key: '',
          range: 0,
          mid: 0,
          vare: 0,
          des: 0,
          asi: 0
        }
        calc_element.key = value_id.nombre
        // en esta variable se guardan solo los valores numericos que pertenezcan a valores
        let data_list = []
        let sum = 0 
        let sum2 = 0
        // este es a funcion que suma todos los datos
        $.each(data, function(key, value){
          let item = JSON.parse(value)
          if (item.id_sede == key_id){
            data_list.push(Number(item.valor))
            sum += Number(item.valor)
            sum2 += Number(item.valor) * Number(item.valor)
          }
        })
        // estas son las ecuaciones para calcular los datos
        data_list.sort(function(a, b){return b-a})
        calc_element.range = data_list[0] - data_list[data_list.length-1]
        calc_element.mid = sum / data_list.length
        alert(sum2 + "-" + data_list.length + "-" + calc_element.mid)
        calc_element.var = (sum2 / data_list.length) - ( calc_element.mid ** 2)
        alert(calc_element.var)
        calc_element.des = Math.sqrt(calc_element.var)

        let asimetry = 0
        $.each(data_list, function(key, value){
          asimetry += (Number(value) -  calc_element.mid)
        })

        calc_element.asi = (asimetry ** 3) / (data_list.length * (calc_element.des**3))
        // estas son la ecuaciones encargadas de limpiar para que esten en base 2
        calc_element.range = calc_element.range.toFixed(2)
        calc_element.mid = calc_element.mid.toFixed(2)
        calc_element.var = calc_element.var.toFixed(2)
        alert(calc_element.var)
        calc_element.des = calc_element.des.toFixed(2)
        calc_element.asi = calc_element.asi.toFixed(2)

        $('#content_ranges').append(get_string_of_calc_element(calc_element))
      })

    }, 1000);

    function get_string_of_calc_element(data){
      return `<div class="row mt-3"> 
          <h2>${data.key}</h2>
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
                <td>${data.range}</td>
              </tr>
              <tr>
                <th scope="row">Media</th>
                <td>${data.mid}</td>
              </tr>
              <tr>
                <th scope="row">Varianza</th>
                <td>${data.var}</td>
              </tr>
              <tr>
                <th scope="row">Desviacion tipica</th>
                <td>${data.des}</td>
              </tr>
              <tr>
                <th scope="row">Asimetria</th>
                <td>${data.asi}</td>
              </tr>
            </tbody>
          </table>
        </div>`
    }

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
              <th>Año</th>
              <th>Ciudad</th>
              <th>Valor</th>
            </tr>
          </thead>
          <tbody id='body_table'>
          </tbody>
        </table>
      </div>
      <div id="content_ranges">
      </div>
      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; Andrea & Angelica</p>
        
      </footer>
    </div>

  </body>
</html>