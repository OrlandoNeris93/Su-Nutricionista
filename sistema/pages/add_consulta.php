


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
                
                <!-- /.navbar-top-links -->                
                <?php  require_once "navbar.php";  // se incluye archivo del navbar ?>

                
            </nav>
            <!-- /#page-wrapper --> 
            <div id="page-wrapper">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header bold h1"><i class="fa fa-plus-circle fa-fw"></i> Añadir Consulta</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row  </form>-->
                    <div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading h2 bold">
                                    Datos del Paciente  &nbsp &nbsp &nbsp
                                     <button  class="btn btn-primary col-5" >
                                        <font style="vertical-align: inherit;"></font>
                                        <font style="vertical-align: inherit;"><i class="fa fa-refresh fa-fw"></i> Cambiar Paciente</font>
                                    </button>
                                </div>          

                                <div class="panel-body">
                                    <div class="row">
                                        <form role="form">
                                            <div class="form-group col-lg-6">
                                                <label>Nombre/es</label>
                                                <input class="form-control" value="Susana Natividad" required disabled>
                                            </div>                                                
                                            <div class="form-group col-lg-6">
                                                <label>Apellido/s</label>
                                                <input  class="form-control" value="Gomez" required disabled>
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>D.N.I.</label>
                                                <input type="text" class="form-control" value="123456789"  pattern="[0-9]{1,10}" title="Solo se permiten NUMEROS!" required disabled>
                                            </div>     

                                            <div class="form-group col-lg-6">
                                                <label>Sexo</label>
                                                <input type="text" class="form-control" required disabled>
                                            </div>                                            
                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.panel -->
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="panel panel-default">
                            <div class="panel-heading h2 bold"> Datos de la Consulta </div>
                            <div class="panel-body">
                                <div class="row">
                                    <form role="form">

                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="form-group col-lg-4">
                                                    <label>Fecha Consulta</label>
                                                    <input type="date" class="form-control"  required>
                                                </div>                                                
                                                <div class="form-group col-lg-2">
                                                    <label>Hora Consulta</label>
                                                    <input type="time"  class="form-control" value="Gomez" required>
                                                </div> 
                                            </div>                                            
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label>Edad (Actual)</label>
                                            <input type="number"  class="form-control" placeholder="29" required>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label>Peso (KG)</label>
                                            <input type="number"  class="form-control" placeholder="87,34" required>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label>Talla (CM)</label>
                                            <input  class="form-control" placeholder="180" required>
                                        </div>
                                        <div class="form-group col-lg-3">
                                            <label>Indice de Masa Corporal (IMC)</label>
                                            <input  class="form-control" value="123" required disabled>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Circunferencia de Cintura (CM)</label>
                                            <input type="number" class="form-control" value="1245" required>
                                        </div>     

                                        <div class="form-group col-lg-4">
                                            <label>Circunferencia de Cadera (CM) </label>
                                            <input type="text" class="form-control" required>
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label>Cuantos hijos tiene? </label>
                                            <input type="text" class="form-control" required>
                                        </div> 

                                        <div class="panel-heading h2 bold col-lg-12"> Bioimpedancia </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <form role="form">
                                                    <div class="form-group col-lg-4">
                                                        <label>     % de Masa Muscular</label>
                                                        <input class="form-control" placeholder="21.4" required>
                                                    </div>                                                
                                                    <div class="form-group col-lg-4">
                                                        <label>     % de Masa Grasa</label>
                                                        <input  class="form-control" placeholder="21.4" required >
                                                    </div>
                                                    <div class="form-group col-lg-4">
                                                        <label>     % de Masa Visceral</label>
                                                        <input  class="form-control" placeholder="21.4" required>
                                                    </div>     
                                                </form>
                                            </div>
                                            <!-- /.row (nested) -->
                                        </div>

                                        <div class="panel-heading h2 bold col-lg-12"> Actividad Fisica </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <form role="form">
                                                    <div class="form-group col-lg-4">
                                                        <label>Factor de Actividad</label>
                                                        <select name="factorActividad" id=""  class="form-control">
                                                            <option value="1">Sedentario</option>
                                                            <option value="2">Activo</option>
                                                        </select>                                                
                                                    </div>                                                
                                                    <div class="form-group col-lg-3">
                                                        <label>Horas de Actividad Fisica diaria</label>
                                                        <input type="number" class="form-control" placeholder="2" required>
                                                    </div>
                                                    
                                                    <div class="form-group col-lg-10">
                                                        <label>Observaciones </label>
                                                        <textarea class="form-control" placeholder="Observaciones.." cols="30" rows="10"></textarea>
                                                    </div>

                                                </form>
                                            </div>
                                            <!-- /.row (nested) -->
                                        </div>
                                        
                                    </form>
                                </div>
                                <!-- /.row (nested) -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->

                    <!-- /.col-lg-12 -->
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