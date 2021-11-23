<?php
    
    // inclucion de archivo de conexion e inicio de session
    require_once('../../../conexion.php');
    session_start();

    if(empty($_SESSION['estado'])) // si no exite variable de session, destruye la session creada y redirecciona al login. 
    {
        session_destroy();
        header('location: ../../../');
        
    }else{ // si exite variable de session, hara lo siguente 
         
        
        // con el id de usuario, se extraen los datos del profesional
        $id_usuario =  $_SESSION['id_usuario']; 
        $query_info = mysqli_query($conn,"CALL consulta_info_profesional('$id_usuario');");
        $resultado = mysqli_fetch_assoc($query_info);

        // luego se almanena la informacion en variables locales. para imprimir en los campos que corresponden
        $usuario = $resultado['usuario'];
        $clave = $resultado['clave'];
        $nombre = $resultado['nombre'];
        $apellido = $resultado['apellido'];
        $direccion = $resultado['direccion'];
        $telefono = $resultado['telefono'];
        $dni = $resultado['dni'];
        $correo = $resultado['correo'];
        $matricula = $resultado['matricula'];
        $titulo = $resultado['titulo'];

        //echo $usuario.'  '.$clave.'  '.$nombre.'  '.$apellido.'  '.$direccion.'  '.$telefono.'  '.$dni.'  '.$correo.'  '.$matricula.'  '.$titulo; exit;
    }    
    
?>  

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Su Nutri - Sistema de Soporte para Nutricionistas</title>

        <!-- Bootstrap Core CSS -->
        <link href="../../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../../css/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                <div class="navbar-header">
                    <a class="navbar-brand" href="index.html">Su Nutri</a>
                </div>

                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <ul class="nav navbar-right navbar-top-links">                   
                    <li class="dropdown">
                        <a href="../../salir.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>
                <!-- /.navbar-top-links -->

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">                            
                            <li>
                                <a href="../index.php" class="active"><i class="fa fa-home fa-fw"></i> Principal</a>
                            </li>                            
                            <li>
                                <a href="../perfil.php"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li>
                                <a href="../pacientes.php"><i class="fa fa-users fa-fw"></i> Pacientes</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-table fa-fw"></i> Recetas</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-cubes fa-fw"></i> Ingredientes</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-edit fa-fw"></i> Informes</a>
                            </li>
                        </ul>
                    </div>
                </div>

            </nav>
            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header"><i class="fa fa-user fa-fw fa-x4"></i> Perfil del Profesional </h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>
                <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading h2 bold"> <i class="fa fa-user fa-fw "></i> Datos de la Cuenta </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            
                                            <form role="form" id="form_datos_cuenta_prof">
                                                <div class="form-group col-lg-5">
                                                <input type="hidden"  id="id_usuario"value="<?php echo $id_usuario; ?>">
                                                    <label>Usuario</label>
                                                    <input class="form-control"  id="usuario_cuenta_prof"value="<?php echo $usuario; ?>"  pattern="[A-Za-z0-9_-]{1,15}" title="No se Pueden utilizar caracteres especiales (! + * < > ? ¿ @ )" required>
                                                </div>                                                
                                                <div class="form-group col-lg-5">
                                                    <label>Contraseña</label>
                                                    <input type="text"  id="clave_cuenta_prof"class="form-control" value="<?php echo $clave; ?>" pattern="[A-Za-z0-9_-]{1,15}" title="No se Pueden utilizar caracteres especiales (! + * < > ? ¿ @ )" required>
                                                </div>
                                                <div class="form-group col-lg-5">
                                                    <label></label>
                                                    <button type="submit" id="actualizar_datos_cuenta_prof" class="btn btn-outline btn-success btn-lg">                                                        
                                                        <font style="vertical-align: inherit;"><i class="fa fa-refresh fa-fw"></i> Actualizar Datos</font>
                                                    </button>
                                                </div>  
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="panel panel-default">
                                <div class="panel-heading h2 bold"> Datos Personales </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <form role="form" id="form_datos_pers_prof">
                                            <input type="hidden"   name="action" value="actualizar_datos_profesional">
                                            <input type="hidden"   name= "id_usuario" value="<?php echo $id_usuario; ?>">
                                            <div class="form-group col-lg-6">
                                                <label>Nombre/es</label>
                                                <input class="form-control" name="nombre_prof" value="<?php echo $nombre; ?>" required>
                                            </div>                                                
                                            <div class="form-group col-lg-6">
                                                <label>Apellido/s</label>
                                                <input  class="form-control" name="apellido_prof" value="<?php echo $apellido; ?>" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>DNI</label>
                                                <input type="text" class="form-control" name="dni_prof" value="<?php echo $dni; ?>"  required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Correo</label>
                                                <input type="email" class="form-control" name="correo_prof" value="<?php echo $correo; ?>" required >
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Telefono</label>
                                                <input type="text" class="form-control" name="telefono_prof"  value="<?php echo $telefono; ?>" pattern="[0-9]{1,15}" title="Numero Completo sin 15, espacios o guiones" required >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control" name="direccion_prof"  value="<?php echo $direccion; ?>"  required >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Matricula Profesional</label>
                                                <input number="text" class="form-control" name="matricula_prof" value="<?php echo $matricula; ?>"  pattern="[0-9]{1,10}" title="Solo se admiten NUMEROS." required >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Titulo </label>
                                                <input type="text" class="form-control" name="titulo_prof"  value="<?php echo $titulo; ?>"  required >
                                            </div>
                                            <div class="form-group col-lg-6 justify-content-center align-items-center">
                                                <button type="submit" id="actualizar_datos_personales" class="btn btn-outline btn-success btn-lg">
                                                    <font style="vertical-align: inherit;"></font>
                                                    <font style="vertical-align: inherit;"><i class="fa fa-refresh fa-fw"></i> Actualizar Datos</font>
                                                </button>
                                            </div>                                            

                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
             
                    <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->



        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../../js/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../../js/startmin.js"></script>

        <script src="functions.js"></script>

    </body>
</html>
