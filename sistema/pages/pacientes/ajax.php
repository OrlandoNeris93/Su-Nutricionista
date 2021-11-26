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

    
}
?>