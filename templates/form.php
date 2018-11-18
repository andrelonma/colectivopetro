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
    <script src="../assets/js/jquery-3.3.1.min.js"></script>
    <script src="../assets/js/bootstrap.min.js" ></script>
    <script src="../assets/js/popper.min.js"></script>
    <script src="../assets/js/form.js"></script>
  </head>

  <body class="bg-light">
    <div class="container">
      <div class="py-5 text-center">
        <img class="d-block mx-auto mb-4" src="http://www.ucp.edu.co/portal/wp-content/themes/UCatolica/images/logo.png" alt="">
        <h2>Formulario</h2>
        <p class="lead">Este formulario permitirá obtener un analisis estadistico del crecimiento de la población dada.</p>
      </div>

      <div class="row">
        <div class="col-md-4 order-md-2 mb-4">
          <h4 class="d-flex justify-content-between align-items-center mb-3">
            <span class="text-muted">Sucursales</span>
          </h4>
          <ul class="list-group mb-3" id="year-list">
          </ul>
        </div>
        <div class="col-md-8 order-md-1">
          <form class="needs-validation" id="formulario" method="POST">
            <div class="row">
              <div class="col-md-6 mb-6">
                <label for="ano">Año</label>
                <input type="date" name="date" id="ano" class="form-control">
              </div>
              <div class="col-md-6 mb-6">
                <label for="emp">Sucursales</label>
                <select name="emp" class="custom-select d-block w-100" id="emp" required>
                  <option value="">Seleccione una sucursal...</option>
                </select>
              </div>
              <div class="col-md-12 mb-12 mt-3">
                <label for="ventas">Cantidad de ventas</label>
                <input type="number" class="form-control" id="ventas" required>
              </div>
              <hr>
              <div class="col-md-12 mb-12 mt-3 ">
                <button id="add" class="btn btn-secondary">Añadir</button>
              </div>
            </div>
            <hr class="mb-4">
            <button class="btn btn-primary btn-lg btn-block" type="submit" id='sennd'>Generar estadística</button>
          </form>
        </div>
      </div>

      <footer class="my-5 pt-5 text-muted text-center text-small">
        <p class="mb-1">&copy; Angelica Ramirez Castañeda & Juliana Andrea Londoño</p>
      </footer>
    </div>
  </body>
</html>
