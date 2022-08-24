<?php 

$alert = '';

session_start();

if(!empty($_SESSION))
{
  header('location: sistema/');
}else{
  
  if(!empty($_POST))
  { 
    include 'conexion.php';
    // $ciudad(RECEPTACULO DE LA CADENA RESULTANTE) = mysqli_real_escape_string($enlace(VARIABLE DONDE ESTA LA CONEXION), $ciudad(VARIABLE A ESCANEAR)); 
    
    $usuario=$_POST['usuario'];
    $clave= $_POST['clave'];  
    $usuario_str = mysqli_real_escape_string($conn,$usuario);
    $clave_str = mysqli_real_escape_string($conn,$clave);
    //echo "     ".$usuario."   ".$clave;
    //echo "     ".$usuario_str."   ".$clave_str;  

    if(!empty($usuario_str) and !empty($clave_str))
    {
      // echo "     ".$usuario_str."   ".$clave_str; exit;

      $query_login = mysqli_query($conn,"SELECT u.id_usuario FROM usuarios u
                                         WHERE u.usuario = '$usuario_str' AND u.clave = '$clave_str' AND u.estado = 1");
      $result = mysqli_fetch_assoc($query_login);
      
      if(empty($result))
      {        
        $alert = 'Usuario o Clave Incorrecta';
        session_destroy();

      }else{        
       
          $id_usuario = $result['id_usuario'];
          //$id_profesional = $result['id_profesional'];

          // echo $id['id'];       
          $_SESSION['estado']=true;
          $_SESSION['id_usuario'] =  $id_usuario;
          //$_SESSION['id_profesional'] =  $id_profesional;
          
          header('location: sistema/');       
        }
         

    }else{
      $alert = 'Usuario o Clave Erroneos.. ';
    }  

    mysqli_close($conn);
  }
}



?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.css" >
    <link rel="stylesheet" href="style.css" >

    <title>Bienvenido</title>

  </head>

  <body>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <form action="" method="POST" class="box">
                        <h1>Ingreso</h1>
                        <p class="alert" style="color: white; font-size: large;"><?php echo $alert; ?> </p>
                        <p class="text-muted"> Por favor, Ingrese su Usuario y Clave!</p>
                        <input type="text" name="usuario" placeholder="Usuario" pattern="[A-Za-z0-9_-]{1,15}" title="No se Pueden utilizar caracteres especiales (! + * < > ? ¿ @ )" required>
                        <input type="password" name="clave" placeholder="Clave" pattern="[A-Za-z0-9_-]{1,15}" title="No se Pueden utilizar caracteres especiales (! + * < > ? ¿ @ )" required> 
                        <a class="forgot text-muted" href="#">Olvido su Contraseña?</a>
                        <input type="submit" name="" value="Ingresar">
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="js/bootstrap.bundle.min.js" ></script>


  </body>
</html>