<?php 
session_start();

if(empty($_SESSION)) // si no existe session iniciada, sera redireccionado al login-
{
    header('location: ../../');
    //echo "sesion vacia"; exit;
    
}else{

    print_r($_SESSION); 

    if(empty($_SESSION['id_usuario']))  // si no existe id de usuario, sera redireccionado al login-
    {
        header('location: ../../');    

    }else{
        //$id_usuario = $_SESSION['id_usuario'];
        //echo "<br>".$id_usuario; 
    }

    
}


 
/*
if($_SESSION['estado'] == true)
{
   
 if(!empty($_SESSION['id_usuario']))
    {
        $id_usuario = $_SESSION['id_usuario'];
        echo $id_usuario;
    }else{
        header('location: ../../index.php');
    }
}else{
    header('location: ../');
} 
*/

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Su Nutri - Sistema Experto</title>

        <!-- Bootstrap Core CSS -->
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="../css/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="../css/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                        <a href="../salir.php"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                    </li>
                </ul>

                <!-- /.navbar-top-links -->                
              <?php  require_once "navbar.php";  // se incluye archivo del navbar ?>
               
            </nav>

            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Principal</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <div class="row ">
                                        <div class="col-xs-3">
                                            <i class="fa fa-plus fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right h2">                                            
                                            <div>Nueva Consulta</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="add_consulta.php">
                                    <div class="panel-footer">                                       
                                        <span class="pull-right"><i class="fa fa-plus-circle fa-3x"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-green">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-user-plus fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right h2">                            
                                            <div>Agregar Paciente</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="add_paciente.php">
                                    <div class="panel-footer">
                                        <span class="pull-right"><i class="fa fa-plus-circle fa-3x"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-yellow">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-book fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right h2">
                                            <div>Nueva Receta</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-right"><i class="fa fa-plus-circle fa-3x"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel panel-red">
                                <div class="panel-heading">
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <i class="fa fa-edit fa-5x"></i>
                                        </div>
                                        <div class="col-xs-9 text-right h2">
                                            <div>Nuevo Informe</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="#">
                                    <div class="panel-footer">
                                        <span class="pull-right"><i class="fa fa-plus-circle fa-3x"></i></span>
                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bar-chart-o fa-fw"></i> Area Chart Example                                    
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div id="morris-area-chart"></div>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel --> 
                        </div>
                        <!-- /.col-lg-8 -->
                        <div class="col-lg-4">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <i class="fa fa-bell fa-fw"></i> Notifications Panel
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-comment fa-fw"></i> New Comment
                                                <span class="pull-right text-muted small"><em>4 minutes ago</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-twitter fa-fw"></i> 3 New Followers
                                                <span class="pull-right text-muted small"><em>12 minutes ago</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-envelope fa-fw"></i> Message Sent
                                                <span class="pull-right text-muted small"><em>27 minutes ago</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-tasks fa-fw"></i> New Task
                                                <span class="pull-right text-muted small"><em>43 minutes ago</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-upload fa-fw"></i> Server Rebooted
                                                <span class="pull-right text-muted small"><em>11:32 AM</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-bolt fa-fw"></i> Server Crashed!
                                                <span class="pull-right text-muted small"><em>11:13 AM</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-warning fa-fw"></i> Server Not Responding
                                                <span class="pull-right text-muted small"><em>10:57 AM</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-shopping-cart fa-fw"></i> New Order Placed
                                                <span class="pull-right text-muted small"><em>9:49 AM</em>
                                                </span>
                                        </a>
                                        <a href="#" class="list-group-item">
                                            <i class="fa fa-money fa-fw"></i> Payment Received
                                                <span class="pull-right text-muted small"><em>Yesterday</em>
                                                </span>
                                        </a>
                                    </div>
                                    <!-- /.list-group -->
                                    <a href="#" class="btn btn-default btn-block">View All Alerts</a>
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-4 -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <!-- jQuery -->
        <script src="../js/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="../js/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="../js/metisMenu.min.js"></script>

        <!-- Morris Charts JavaScript -->
        <script src="../js/raphael.min.js"></script>
        <script src="../js/morris.min.js"></script>
        <script src="../js/morris-data.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

    </body>
</html>
