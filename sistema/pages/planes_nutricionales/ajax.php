<?php

require_once('../../../conexion.php');

if (!empty($_POST)){

    
    if ($_POST['action'] == 'guardar_antropometria') 
    {
        $c_cadera_pac;
        //echo json_encode($_POST,JSON_UNESCAPED_UNICODE ); exit;
        if($_POST["c_cadera_pac"] != "")
        {
            $c_cadera_pac = $_POST["c_cadera_pac"];
        }else{
            $c_cadera_pac = 0;
        }    

        $c_cintura_pac = $_POST["c_cintura_pac"];
        $clasif_cintura_pac = $_POST["clasif_cintura_pac"];
        $clasif_g_visceral = $_POST["clasif_g_visceral"];
        $clasif_imc_pac = $_POST["clasif_imc_pac"];
        $clasif_masa_grasa = $_POST["clasif_masa_grasa"];
        $clasif_masa_musc = $_POST["clasif_masa_musc"];
        $diagnostico_pac = $_POST["diagnostico_pac"];
        $edad_actual = $_POST["edad_actual"];        
        $g_visceral_pac = $_POST["g_visceral_pac"];
        $id_paciente = $_POST["id_paciente"];
        $imc_pac = $_POST["imc_pac"];
        $masa_grasa_pac = $_POST["masa_grasa_pac"];
        $masa_musc_pac = $_POST["masa_musc_pac"];
        $peso_pac = $_POST["peso_pac"];
        $talla_pac = $_POST["talla_pac"];
        
        $fecha_consulta = $_POST["fecha_consulta"];
        $timestamp = strtotime($fecha_consulta); 
        $fecha_consulta= date("Y-m-d", $timestamp );
        
        $query_insert = mysqli_query($conn,"CALL add_consulta('$fecha_consulta',$c_cintura_pac,'$clasif_cintura_pac',$c_cadera_pac,$peso_pac,
                                                              '$clasif_g_visceral','$clasif_imc_pac','$clasif_masa_grasa','$clasif_masa_musc',
                                                              '$diagnostico_pac',$edad_actual,$g_visceral_pac,$imc_pac,$masa_grasa_pac,
                                                              $masa_musc_pac,$talla_pac,$id_paciente);");
        
        if($query_insert){
            echo "Consulta Guardada con Exito! ";
        }else{
            echo "Error al Guardar los Datos!";            
        }
        mysqli_close($conn); 
    }
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
        $hijos_pac = $_POST["hijos_pac"];
        

        $fecha_nac_pac_original = $_POST["fecha_nac_pac"];
        $timestamp = strtotime($fecha_nac_pac_original); 
        $fecha_nac_pac = date("Y-m-d", $timestamp );

        //$prueba = $nombre_pac.'  '.$apellido_pac.'  '.$dni_pac.'  '.$fecha_nac_pac.'  '.$sexo_pac.'  '.$correo_pac.'  '.$telefono_pac.'  '.$direccion_pac;
        
        $query_insert = mysqli_query($conn,"CALL add_nuevo_paciente('$nombre_pac', '$apellido_pac', '$dni_pac ',' $fecha_nac_pac', '$sexo_pac', '$correo_pac', '$telefono_pac', '$direccion_pac','$hijos_pac');");
        $resultado = mysqli_fetch_assoc($query_insert);
        if($query_insert){
            echo json_encode($resultado, JSON_UNESCAPED_UNICODE);
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
                                        <button type="button" class="btn btn-outline btn-primary" onclick="añadir_paciente_plan('.$datos['id_usuario'].');"><i class="fa fa-plus"></i></button>
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
                                     <button type="button" onclick="añadir_paciente_plan('.$datos['id_usuario'].');" class="btn btn-outline btn-primary"><i class="fa fa-plus"></i></button>
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
   
    if ($_POST['action'] == 'info_paciente') 
    {
        
        $id_paciente = $_POST['id_paciente'];
        $query_info_paciente = mysqli_query($conn,"CALL info_paciente($id_paciente);");
        
        if($query_info_paciente)
        {
            $info_paciente = mysqli_fetch_assoc($query_info_paciente);
            echo json_encode($info_paciente, JSON_UNESCAPED_UNICODE);
        }else{
            echo "error al buscar los datos ";
        }
    
        mysqli_close($conn);
   
    }
    
}
?>