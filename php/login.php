<?php include('db.php'); ?>

<?php

    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = "SELECT * FROM usuarios WHERE nombre_usuario = '$username'";
    $result = $conn->query($sql);
   
    if ($result->num_rows > 0) {    
         $row = $result->fetch_array(MYSQLI_ASSOC);
      
         if ($password == $row['contrasena']) { 

            $_SESSION['loggedin'] = true;
       
            $_SESSION['username'] = $row['nombre'];
       
            $_SESSION['start'] = time();
       
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);

?>
        
            <!doctype html>
                <html lang="en">
                <head>
                    <meta charset="utf-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
                    <meta name="description" content="">
                    <meta name="author" content="">

                    <title>Formulario</title>

                    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
                    <link href="../assets/css/form-validation.css" rel="stylesheet">
                </head>

                <body class="bg-light">

                    <div class="container">
                    <div class="py-5 text-center">
                        <img class="d-block mx-auto mb-4" src="http://www.ucp.edu.co/portal/wp-content/themes/UCatolica/images/logo.png" alt="">
                        <h2>Bienvenido <?php $username ?></h2>
                        <p class="lead">Este formulario permitirá obtener un analisis estadistico del crecimiento de la población dada.</p>
                    </div>

                    <div class="row">
                        <div class="col-md-4 order-md-2 mb-4">
                        <h4 class="d-flex justify-content-between align-items-center mb-3">
                            <span class="text-muted">Años agregados</span>
                        </h4>
                        <ul class="list-group mb-3" id="year-list">
                        </ul>
                        </div>
                        <div class="col-md-8 order-md-1">
                        <form class="needs-validation" id="formulario" novalidate>
                            


                            <div class="row">
                            <div class="col-md-6 mb-6">
                                <label for="country">Año</label>
                                <select class="custom-select d-block w-100" id="ano" required>
                                <option value="">Seleccione un año...</option>
                                <option>1990</option>
                                <option>1991</option>
                                <option>1992</option>
                                <option>1993</option>
                                <option>1994</option>
                                <option>1995</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-6">
                                <label for="zip">Cantidad de habitantes</label>
                                <input type="text" class="form-control" id="habs" placeholder="" required>
                            </div>
                            <hr>
                            <div class="col-md-12 mb-12 mt-3 ">
                                <button id="add" class="btn btn-secondary">Añadir</button>
                            </div>
                            
                            </div>
                            <hr class="mb-4">
                            <button class="btn btn-primary btn-lg btn-block" type="submit">Generar estadística</button>
                        </form>
                        </div>
                    </div>

                    <footer class="my-5 pt-5 text-muted text-center text-small">
                        <p class="mb-1">&copy; Andrea</p>
                    </footer>
                    </div>

                    <!-- Bootstrap core JavaScript
                    ================================================== -->
                    <!-- Placed at the end of the document so the pages load faster -->
                    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
                    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
                    <script src="../assets/js/form.js"></script>
                </body>
            </html>
<?php
         } else { 
      
           echo "Username o Password estan incorrectos.";  
           
       
         }  
    } else {
        echo "Usuario no encontrado";
    }
    mysqli_close($conn);
?>
