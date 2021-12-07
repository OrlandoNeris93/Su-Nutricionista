
<?php
    session_start();

    if(empty( $_SESSION['estado']))
    {
        session_destroy();
        header('location: ../../');
        
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
        <link href="../css/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="../css/metisMenu.min.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="../css/startmin.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

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
                    <a class="navbar-brand" href="../">Su Nutri</a>
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

                <div class="navbar-default sidebar" role="navigation">
                    <div class="sidebar-nav navbar-collapse">
                        <ul class="nav" id="side-menu">                            
                            <li>
                                <a href="index.php" class="active"><i class="fa fa-home fa-fw"></i> Principal</a>
                            </li>                            
                            <li>
                                <a href="profesional/"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li>
                                <a href="pacientes/"><i class="fa fa-users fa-fw"></i> Pacientes</a>
                            </li>
                            <li>
                                <a href="planes_nutricionales/"><i class="fa fa-book fa-fw"></i>Nuevo Plan</a>
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
                            <h1 class="page-header">Principal</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                </div>

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
                                <a href="consultas/">
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
                                <a href="pacientes/">
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
                                            <div>Nuevo Plan Nutricional</div>
                                        </div>
                                    </div>
                                </div>
                                <a href="planes_nutricionales">
                                    <div class="panel-footer">
                                        <span class="pull-right"><i class="fa fa-plus-circle fa-3x"></i></span>

                                        <div class="clearfix"></div>
                                    </div>
                                </a>
                            </div>
                    </div>
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

        <!-- Custom Theme JavaScript -->
        <script src="../js/startmin.js"></script>

        <script src="functions.js"></script>

    </body>
</html>
