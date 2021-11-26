<?php
    
    // inclucion de archivo de conexion e inicio de session
    require_once('../../../conexion.php');
    session_start();

    if(empty($_SESSION['estado'])) // si no exite variable de session, destruye la session creada y redirecciona al login. 
    {
        session_destroy();
        header('location: ../../../');
        
    }else{ // si exite variable de session, hara lo siguente 
         
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
                                <a href="../profesional/"><i class="fa fa-user fa-fw"></i> Perfil</a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-users fa-fw"></i> Pacientes</a>
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
                            <h1 class="page-header bold h1"><i class="fa fa-users fa-fw"></i> Pacientes</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                        
                    </div>
                    <!-- formulario busqueda -->
                    <div class="row">
                       <div class="col-lg-12">
                        <div class="panel panel-default">                            
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <form role="form">
                                            <div class="form-group col-lg-6 ">
                                                <div class="form-group input-group">                                                    
                                                    <span class="input-group-btn">
                                                        <button class="btn btn-default" type="button" disabled><i class="fa fa-search fa-2x"></i>
                                                        </button>
                                                    </span>
                                                    <input type="text" class="form-control" id="buscar_paciente" style="height: 43px;" placeholder="Buscar Paciente.. ">
                                                </div>
                                            </div>                                                
                                            <div class="form-group col-lg-6">
                                                <!-- Button to trigger modal -->
                                                <button type="button" class="btn btn-outline btn-primary btn-lg btn-block" data-toggle="modal" data-target="#modal_add_paciente">
                                                    <i class="fa fa-user-plus "></i>  Añadir Paciente
                                                </button>
                                            </div>  
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading h3"> Lista de Pacientes</div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="listado_pacientes" >
                                            <thead>
                                                <tr>                                                    
                                                    <th>Apellido/s</th>
                                                    <th colspan="2">Nombre/s</th>
                                                    <th>DNI</th>
                                                    <th >Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody id="listado_pacientes_lista">

                                            </tbody>
                                        </table>
                                    </div>          
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->                   
                </div>
               
                    <!-- /.container-fluid -->
            </div>

            <!-- /#page-wrapper -->

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

        <script>listado_pacientes();</script>




        <!-- modal add Paciente --> 
            <!-- Button trigger modal -->
                <!-- Modal -->
                <div class="modal fade" id="modal_add_paciente" tabindex="-1" role="dialog" aria-labelledby="modal_add_paciente" aria-hidden="true">
                <div style="width:50%;" class="modal-dialog" role="document">
                    <div class="modal-content col-lg-9">
                    <div class="modal-header">
                        <h5 class="modal-title h1" id="titulo_modal"><i class="fa fa-user-plus fa-fw"></i> Añadir Paciente</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">                       
                            <div class="panel panel-default">
                                <div class="panel-heading h2 bold"> Datos Personales </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <form role="form" id="form_add_paciente">
                                            <input type="hidden" name="action" value="add_paciente" >
                                            <div class="form-group col-lg-6">
                                                <label>Nombre/es</label>
                                                <input class="form-control" id="nombre_pac"  name="nombre_pac"  placeholder="Nombre del Paciente" required>
                                            </div>                                                
                                            <div class="form-group col-lg-6">
                                                <label>Apellido/s</label>
                                                <input  class="form-control"  id="apellido_pac"  name="apellido_pac" placeholder="Apellido del Paciente" required>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>D.N.I.</label>
                                                <input type="text" class="form-control"  id="dni_pac" name="dni_pac" placeholder="DNI del Paciente"  pattern="[0-9]{1,10}" title="Solo se permiten NUMEROS!" required>
                                            </div>     

                                            <div class="form-group col-lg-6">
                                                <label>Fecha de Nac</label>
                                                <input type="date" class="form-control" id="fecha_nac_pac" name="fecha_nac_pac" required >
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Sexo</label>
                                                <select name="sexo_pac"  id="sexo_pac"  class="form-control">
                                                    <option value="M">Masculino</option>
                                                    <option value="F">Femenino</option>
                                                </select>                                                
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Correo Electronico</label>
                                                <input type="email" class="form-control"  id="correo_pac"   name="correo_pac" placeholder="Correo Electronico Paciente" required >
                                            </div>

                                            <div class="form-group col-lg-6">
                                                <label>Telefono</label>
                                                <input type="text" class="form-control"   id="telefono_pac" name="telefono_pac" placeholder="Numero sin 15 ni espacios " pattern="[0-9]{1,15}" title="Numero Completo sin 15, espacios o guiones" required >
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Direccion</label>
                                                <input type="text" class="form-control"  id="direccion_pac" name="direccion_pac" placeholder="Direccion del Paciente"  required >
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" onclick="limpiar_modal_add_paciente();" data-dismiss="modal">Cerrar</button>
                                                <button type="submit" id="guardar_nuevo_pac" class="btn btn-primary ">Guardar</button>
                                            </div>                                            
                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>                    
                    </div>
                </div>
        <!-- fin modal add Paciente --> 


    </body>
</html>
