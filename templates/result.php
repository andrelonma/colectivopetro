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
      console.log(data)
      $.each(callback, function(key, value){
        let item = JSON.parse(value)
        if (item.ano != "" && item.valor != ''){
          list.push([parseInt(item.ano), parseInt(item.valor)])
        }
      })
    })

    console.log(data)

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
            <tr>
              <th scope="col">Año</th>
              <th scope="col">Manizales</th>
              <th scope="col">Bogota</th>
              <th scope="col">Pereira</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th scope="row">2015</th>
              <td>1200000</td>
              <td>130000</td>
              <td>5000000</td>
            </tr>
            <tr>
              <th scope="row">2012</th>
              <td>120000</td>
              <td>234000</td>
              <td>2500000</td>
            </tr>
            <tr>
              <th scope="row">2017</th>
              <td>5000000</td>
              <td>250000</td>
              <td>670000</td>
            </tr>
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