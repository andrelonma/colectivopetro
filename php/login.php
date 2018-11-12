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
       
            $_SESSION['username'] = $row['nombre_completo'];

            $_SESSION['id'] = $row['id'];
       
            $_SESSION['start'] = time();
       
            $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
            header("Location: ../templates/form.php");
            die();
         } else { 
           echo "Username o Password estan incorrectos.";  
         }  
    } else {
        echo "Usuario no encontrado";
    }
    mysqli_close($conn);
?>
