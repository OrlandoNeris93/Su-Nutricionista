<?php

require_once('../../../conexion.php');

if (!empty($_POST)){

    // ACTUALIZAR PERSONALES DEL PROFESIONAL.
    if ($_POST['action'] == 'add_paciente') 
    {   
        // echo json_encode($_POST,JSON_UNESCAPED_UNICODE ); exit;
           
        $nombre_pac   = $_POST["nombre_pac"];
        $apellido_pac = $_POST["apellido_pac"];
        $dni_pac      = $_POST["dni_pac"];
        $sexo_pac = $_POST["sexo_pac"];
        $correo_pac   = $_POST["correo_pac"];
        $telefono_pac = $_POST["telefono_pac"];
        $direccion_pac = $_POST["direccion_pac"];
        

        $fecha_nac_pac_original = $_POST["fecha_nac_pac"];
        $timestamp = strtotime($fecha_nac_pac_original); 
        $fecha_nac_pac = date("Y-m-d", $timestamp );

        //$prueba = $nombre_pac.'  '.$apellido_pac.'  '.$dni_pac.'  '.$fecha_nac_pac.'  '.$sexo_pac.'  '.$correo_pac.'  '.$telefono_pac.'  '.$direccion_pac;
        
        $query_insert = mysqli_query($conn,"CALL add_nuevo_paciente('$nombre_pac', '$apellido_pac', '$dni_pac ',' $fecha_nac_pac', '$sexo_pac', '$correo_pac', '$telefono_pac', '$direccion_pac');");
        
        if($query_insert){
            echo "Datos Guardados Exitosamente!";
        }else{
            echo "Error al Guardar los Datos!";            
        }
        mysqli_close($conn); 
    }

    if ($_POST['action'] == 'lista_pacientes') 
    {            
        $query_listado_pacientes = mysqli_query($conn,"CALL lista_pacientes();");
        $resultado_lista = mysqli_num_rows($query_listado_pacientes);  
    
        $detalleTabla = '';

        if ($resultado_lista > 0) 
        {
            // armado de las filas del detalle de la receta
            while ($datos = mysqli_fetch_assoc($query_listado_pacientes)) 
            {                        
                $detalleTabla .= '<tr class="odd gradeX">                                    
                                     <td>'.$datos['apellido'].'</td>
                                     <td colspan="2">'.$datos['nombre'].'</td>
                                     <td>'.$datos['dni'].'</td>                                                                 
                                     <td class="center">
                                        <button type="button" class="btn btn-outline btn-primary  btn-block" data-toggle="modal" data-target="#modal_editar_paciente">
                                            <i class="fa fa-user-info "></i> Info Paciente
                                        </button>
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>                                       
                                        <button type="button" class="btn btn-outline btn-warning" value="'.$datos['id_usuario'].'"<i class="fa fa-edit"></i> Editar</button>
                                        <button type="button" class="btn btn-outline btn-danger" value="'.$datos['id_usuario'].'" ><i class="fa fa-close"></i> Eliminar</button>
                                    </td>
                                </tr>';
                                
                         
            // fin while	
            }
            echo json_encode($detalleTabla, JSON_UNESCAPED_UNICODE);
    
        }else{
            echo 'error';
        }

        mysqli_close($conn);
            
    }
    
    if ($_POST['action'] == 'buscar_paciente') 
    {            
        $texto = $_POST['buscar'];
        
        if(strlen($texto) >= 3)
        {
            $query_buscar_paciente = mysqli_query($conn,"CALL buscar_paciente('$texto');");
            $resultado_lista = mysqli_num_rows($query_buscar_paciente);  
    
            $detalleTabla = '';

            if ($resultado_lista > 0) 
            {
                // armado de las filas del detalle de la receta
                while ($datos = mysqli_fetch_assoc($query_buscar_paciente)) 
                {                        
                $detalleTabla .= '<tr class="odd gradeX">                                    
                                     <td>'.$datos['apellido'].'</td>
                                     <td colspan="2">'.$datos['nombre'].'</td>
                                     <td>'.$datos['dni'].'</td>                                                                 
                                     <td class="center">
                                        <button type="button" class="btn btn-outline btn-primary" value="'.$datos['id_usuario'].'"<i class="fa fa-info"></i> Info Paciente</button>                                        
                                        <button type="button" class="btn btn-outline btn-warning" value="'.$datos['id_usuario'].'"<i class="fa fa-edit"></i> Editar</button>
                                        <button type="button" class="btn btn-outline btn-danger" value="'.$datos['id_usuario'].'" ><i class="fa fa-close"></i> Eliminar</button>
                                    </td>
                                </tr>';
                                
                // fin while	
                }                
                echo json_encode($detalleTabla, JSON_UNESCAPED_UNICODE);
    
            }else{
                echo '';
            }
            mysqli_close($conn);
        }       
    }
    
    if ($_POST['action'] == 'modal_add_paciente') 
    {            
    
            $cuerpo_modal = '';

            $cuerpo_modal .= '        <!-- modal add Paciente --> 
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
        <!-- fin modal add Paciente -->  ';
                                            
            echo json_encode($cuerpo_modal, JSON_UNESCAPED_UNICODE);
    

      
    }
    
}
?>