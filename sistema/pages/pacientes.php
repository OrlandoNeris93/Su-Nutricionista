


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
            <!-- /#page-wrapper --> 
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
                                                    <input type="text" class="form-control" style="height: 43px;" placeholder="Buscar Paciente.. ">
                                                </div>
                                            </div>                                                
                                            <div class="form-group col-lg-6">
                                                <a href="add_paciente.php" class="btn btn-outline btn-primary btn-lg btn-block"  style="height: 43px;"><i class="fa fa-user-plus "></i>  Añadir Paciente</a>
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
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Cod</th>
                                                    <th>Apellido/s</th>
                                                    <th>Nombre/s</th>
                                                    <th>DNI</th>
                                                    <th >Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
                                                    <td>1</td>
                                                    <td>Solis</td>
                                                    <td>Marco Antoño</td>
                                                    <td >40293023</td>
                                                    <td class="center">
                                                        <button type="button" class="btn btn-outline btn-success"><i class="fa fa-plus"></i> Agregar Consulta</button>
                                                        <button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i> Editar</button>
                                                        <button type="button" class="btn btn-outline btn-danger"><i class="fa fa-close"></i> Eliminar</button>
                                                    </td>                                    
                                                </tr>
                                                <tr class="odd gradeX">
                                                    <td>1</td>
                                                    <td>Solis</td>
                                                    <td>Marco Antoño</td>
                                                    <td >40293023</td>
                                                    <td class="center">
                                                        <button type="button" class="btn btn-outline btn-success"><i class="fa fa-plus"></i> Agregar Consulta</button>
                                                        <button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i> Editar</button>
                                                        <button type="button" class="btn btn-outline btn-danger"><i class="fa fa-close"></i> Eliminar</button>
                                                    </td>                                    
                                                </tr>
                                                <tr class="odd gradeX">
                                                    <td>1</td>
                                                    <td>Solis</td>
                                                    <td>Marco Antoño</td>
                                                    <td >40293023</td>
                                                    <td class="center">
                                                        <button type="button" class="btn btn-outline btn-success"><i class="fa fa-plus"></i> Agregar Consulta</button>
                                                        <button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i> Editar</button>
                                                        <button type="button" class="btn btn-outline btn-danger"><i class="fa fa-close"></i> Eliminar</button>
                                                    </td>                                    
                                                </tr>
                                                <tr class="odd gradeX">
                                                    <td>1</td>
                                                    <td>Solis</td>
                                                    <td>Marco Antoño</td>
                                                    <td >40293023</td>
                                                    <td class="center">
                                                        <button type="button" class="btn btn-outline btn-success"><i class="fa fa-plus"></i> Agregar Consulta</button>
                                                        <button type="button" class="btn btn-outline btn-warning"><i class="fa fa-edit"></i> Editar</button>
                                                        <button type="button" class="btn btn-outline btn-danger"><i class="fa fa-close"></i> Eliminar</button>
                                                    </td>                                    
                                                </tr>
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