<?php
    
    // inclucion de archivo de conexion e inicio de session
    require_once('../../../conexion.php');
    session_start();
    $id_profesional;
    if(empty($_SESSION['estado'])) // si no exite variable de session, destruye la session creada y redirecciona al login. 
    {
        session_destroy();
        header('location: ../../../');
        
    }else{ // si exite variable de session, hara lo siguente 
         
        $id_profesional = $_SESSION['id_profesional'];
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
                                <a href="../pacientes/"><i class="fa fa-users fa-fw"></i> Pacientes</a>
                            </li>
                            <li>
                                <a href="../planes_nutricionales/"><i class="fa fa-book fa-fw"></i> Nuevo Plan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- contenido de pagina -->

            <!-- Page Content -->
            <div id="page-wrapper">
                <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <h1 class="page-header bold h1"><i class="fa fa-plus-circle fa-fw"></i> Nueva Consulta </h1>
                            </div>
                            <!-- /.col-lg-12 -->
                        </div>
                        <!-- /.row inicio formulario alta paciente-->
                        <div class="row">
                                <div class="panel panel-default">
                                    <div class="panel-heading h2 bold">
                                        Datos del Paciente  &nbsp &nbsp &nbsp
                                        <button  class="btn btn-primary col-5" data-toggle="modal" data-target="#modal_buscar_paciente" >
                                            <font style="vertical-align: inherit;"></font>
                                            <font style="vertical-align: inherit;" ><i class="fa fa-refresh fa-fw"></i> Cambiar Paciente</font>
                                        </button>                                        
                                    </div>          
                                    <div class="panel-body">
                                        <div class="row">
                                            <form role="form" id="form_add_paciente">
                                                <input type="hidden" name="id_usuario " id="id_usuario" value="" >
                                                <input type="hidden" name="action" value="add_paciente" >
                                                <div class="form-group col-lg-4">
                                                    <label>Nombre/es</label>
                                                    <input class="form-control" id="nombre_pac"  name="nombre_pac"  placeholder="Nombre del Paciente" required>
                                                </div>                                                
                                                <div class="form-group col-lg-4">
                                                    <label>Apellido/s</label>
                                                    <input  class="form-control"  id="apellido_pac"  name="apellido_pac" placeholder="Apellido del Paciente" required>
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>D.N.I.</label>
                                                    <input type="text" class="form-control"  id="dni_pac" name="dni_pac" placeholder="DNI del Paciente"  pattern="[0-9]{1,10}" title="Solo se permiten NUMEROS!" required>
                                                </div>     

                                                <div class="form-group col-lg-4">
                                                    <label>Fecha de Nac</label>
                                                    <input type="date" class="form-control" id="fecha_nac_pac" name="fecha_nac_pac" required >
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>Sexo</label>
                                                    <select name="sexo_pac"  id="sexo_pac"  class="form-control">
                                                        <option value="M">Masculino</option>
                                                        <option value="F">Femenino</option>
                                                    </select>                                                
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>Correo Electronico</label>
                                                    <input type="email" class="form-control"  id="correo_pac"   name="correo_pac" placeholder="Correo Electronico Paciente" required >
                                                </div>

                                                <div class="form-group col-lg-4">
                                                    <label>Telefono</label>
                                                    <input type="text" class="form-control"   id="telefono_pac" name="telefono_pac" placeholder="Numero sin 15 ni espacios " pattern="[0-9]{1,15}" title="Numero Completo sin 15, espacios o guiones" required >
                                                </div>
                                                <div class="form-group col-lg-4">
                                                    <label>Direccion</label>
                                                    <input type="text" class="form-control"  id="direccion_pac" name="direccion_pac" placeholder="Direccion del Paciente"  required >
                                                </div> 
                                                <div class="form-group col-lg-4 col-md-4">
                                                    <label>Cuantos hijos tiene? </label>
                                                    <input type="number" id="hijos_pac" name="hijos_pac" class="form-control" required>
                                                </div>                                        
                                                <div class="form-group col-lg-4">    
                                                    <button type="submit" style="display:none;" id="guardar_nuevo_pac" class="btn btn-primary btn-lg btn-outline"><i class="fa fa-save"></i> Guardar</button>
                                                </div>                                         
                                            </form>
                                        </div>
                                        <!-- /.row (nested) -->
                                    </div>
                                    <!-- /.panel-body -->
                                </div>                                
                        </div>
                        <!-- /.row fin formulario alta paciente -->

                        <div class="row">
                            <!-- /.row inicio formulario carga consulta -->
                            <div class="panel panel-default" id="panel-datos-consulta">
                                <div class="panel-heading h2 bold">
                                    Datos Antropometricos   
                                </div>
                                
                                <div class="panel-body">
                                    <div class="row">
                                        <form id="form_antropometria"  role="form">
                                            <input type="hidden" name="id_paciente" id="id_paciente_antropometria" >
                                            <input type="hidden" name="action" value="guardar_antropometria">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-lg-2 col-md-2 col-sm-4">
                                                        <label>Fecha Consulta</label>
                                                        <input type="date" class="form-control"  id="fecha_consulta" name="fecha_consulta"  required>
                                                    </div>
                                                </div>                                            
                                            </div>
                                            <div class="form-group col-lg-2 col-md-3">
                                                <label>Edad (Actual)</label>
                                                <input type="text" value="" class="form-control" id="edad_actual" name="edad_actual"  required disabled>
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2">
                                                <label>Peso (KG)</label>
                                                <input type="number" id="peso_pac" step="000.01" onchange="calculo_imc()" name="peso_pac" class="form-control" placeholder="87,34" required>
                                            </div>
                                            <div class="form-group col-lg-2 col-md-2">
                                                <label>Talla (CM)</label>
                                                <input  class="form-control" id="talla_pac" onchange="calculo_imc()" name="talla_pac" placeholder="180" required>
                                            </div>
                                            <br>
                                            <div class="form-group col-lg-12 col-md-12">
                                                <div class="container col-lg-3 col-md-3">
                                                    <label>Indice de Masa Corporal (IMC)</label>
                                                    <input  class="form-control" id="imc_pac" name="imc_pac" required disabled>                                                    
                                                </div>
                                                <div class="container col-lg-4 col-md-5">
                                                    <label>Clasificacion</label>
                                                    <input  class="form-control" id="clasif_imc_pac" name="clasif_imc_pac" required disabled>                                                    
                                                </div>                                                                                                                                
                                            </div>
                                            <div class="form-group col-lg-12 col-md-12">
                                                <div class="container-fluid col-lg-3 col-md-3">
                                                    <label>Circunferencia de Cintura (CM)</label>
                                                    <input type="number" id="c_cintura_pac" onchange="clasif_cintura();"  name="c_cintura_pac" class="form-control" placeholder="80" required>
                                                </div> 
                                                <div class="container col-lg-4 col-md-5">
                                                    <label>Riesgo Cardiometabolico</label>
                                                    <input type="text" id="clasif_cintura_pac"  name="clasif_cintura_pac" class="form-control"  required disabled>
                                                </div>                                               
                                            </div>                                                 
                                            <div class="form-group col-lg-12 col-md-12">
                                                <div class="container-fluid col-lg-3 col-md-3">
                                                    <label>Circunferencia de Cadera (CM) </label>
                                                    <input type="text" id="c_cadera_pac" name="c_cadera_pac" class="form-control" >                                                    
                                                </div>                                                
                                            </div>
                                            <br>
                                            
                                            <div class="panel-heading h2 bold col-lg-12"> Bioimpedancia </div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Porcentarje (%) Masa Muscular</label>
                                                            <input  class="form-control"  onchange="clasif_masa_muscular();" id="masa_musc_pac" name="masa_musc_pac" placeholder="21.5" required >                                                    
                                                        </div>
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Clasificacion</label>
                                                            <input  class="form-control"  id="clasif_masa_musc" name="clasif_masa_musc"  required disabled>                                                    
                                                        </div>                                                                                                                                
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Porcentarje (%) Masa Grasa</label>
                                                            <input  class="form-control" id="masa_grasa_pac" onchange="clasificacion_masa_grasa();" placeholder="21.5" name="masa_grasa_pac" required >                                                    
                                                        </div>
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Clasificacion</label>
                                                            <input  class="form-control" id="clasif_masa_grasa" name="clasif_masa_grasa" required disabled>                                                    
                                                        </div>                                                                                                                                
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Porcentarje (%) Grasa Visceral</label>
                                                            <input  class="form-control" id="g_visceral_pac" onchange="clasificacion_grasa_v();" name="g_visceral_pac" placeholder="21.5" required >                                                    
                                                        </div>
                                                        <div class="container col-lg-4 col-md-5">
                                                            <label>Clasificacion</label>
                                                            <input  class="form-control" id="clasif_g_visceral" name="clasif_g_visceral" required disabled>                                                    
                                                        </div>                                                                                                                                
                                                    </div>
                                                    <div class="form-group col-lg-12 col-md-12">
                                                        <div class="form-group col-lg-8 col-md-8">
                                                            <label>Diagnostico Nutricional </label>
                                                            <textarea class="form-control" type="text" id="diagnostico_pac" maxlength="500" name="diagnostico_pac" placeholder="Observaciones.." cols="30" rows="6" required></textarea>
                                                        </div>
                                                        <div class="form-group col-lg-5 col-md-5">    
                                                            <button type="submit" id="guardar_antropometria" name="guardar_antropometria" class="btn btn-primary btn-lg btn-outline"><i class="fa fa-save"></i> Guardar Antropometria</button>
                                                        </div>                                                                                                                                
                                                    </div>
                                                    
                                                </div>
                                                <!-- /.row (nested) -->                                                
                                            </div>
                                                                              
                                        </form>
                                    </div>
                                    <!-- /.row (nested) -->
                                </div>
                                <!-- /.panel-body -->
                            </div>
                            <!-- /.row fin formulario carga consulta -->

                            <!-- FIN FORMULARIOS -->
                    </div>
                        <!-- /.container-fluid -->
                </div>
                <!-- /#page-wrapper -->
            </div>
            <!-- /#wrapper -->
            <!-- fin contenido pagina -->

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

        <!-- modal buscar Paciente --> 

        <!-- Button trigger modal -->
            <!-- Modal -->
            <div class="modal fade" id="modal_buscar_paciente" tabindex="-1" role="dialog" aria-labelledby="modal_buscar_paciente" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Buscar Paciente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input  class="form-control col-12" type="text" id="buscar_paciente" placeholder="Ingrese Apellido, Nombre o DNI..." required>
                    <hr>
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>                   
                </div>
                </div>
            </div>
            </div>

        <!-- fin modal buscar Paciente --> 


    </body>
</html>
