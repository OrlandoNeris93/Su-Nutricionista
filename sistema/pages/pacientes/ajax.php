<?php

require_once('../../../conexion.php');

//$_POST['action'] = 'info_paciente';
//$_POST['id_usuario'] = 4;
$_POST['action'] = 'lista_pacientes';
if (!empty($_POST)){

    if ($_POST['action'] == 'actualizar_datos_pac')
    {

        $apellido_pac_editar = $_POST["apellido_pac_editar"];
        $correo_pac_editar = $_POST["correo_pac_editar"];
        $direccion_pac_editar = $_POST["direccion_pac_editar"];
        $dni_pac_editar = $_POST["dni_pac_editar"];        
        $hijos_pac_editar = $_POST["hijos_pac_editar"];
        $id_usuario_editar = $_POST["id_usuario_editar"];
        $nombre_pac_editar = $_POST["nombre_pac_editar"];
        $sexo_pac_editar = $_POST["sexo_pac_editar"];
        $telefono_pac_editar = $_POST["telefono_pac_editar"];

        $fecha_nac_pac_original = $_POST["fecha_nac_pac_editar"];
        $timestamp = strtotime($fecha_nac_pac_original); 
        $fecha_nac_pac_editar = date("Y-m-d", $timestamp );

        $query_actualizar_datos = mysqli_query($conn,"UPDATE usuarios SET nombre = '$nombre_pac_editar', apellido = ' $apellido_pac_editar', 
                                                        dni = '$dni_pac_editar', fecha_nac = ' $fecha_nac_pac_editar', sexo = '$sexo_pac_editar', 
                                                        correo = '$correo_pac_editar', telefono = '$telefono_pac_editar ',
                                                        direccion = '$direccion_pac_editar', hijos = $hijos_pac_editar 
                                                      WHERE id_usuario = $id_usuario_editar AND estado = 1 AND tipo_usuario = 2");
    
        if($query_actualizar_datos)
        {
            echo "Datos Actualizados con Exito!";
        }else{
            echo "No se Pudo Actualizar los Datos";
        }
    
    
    }

    if ($_POST['action'] == 'info_paciente') 
    {
        
        $id_usuario = $_POST['id_usuario'];

        
        $query_info_paciente = mysqli_query($conn,"SELECT * FROM usuarios WHERE id_usuario = $id_usuario;");
        
        if($query_info_paciente)
        {
            $info_paciente = mysqli_fetch_assoc($query_info_paciente);
            echo json_encode($info_paciente, JSON_UNESCAPED_UNICODE);
        }else{
            echo "error al buscar los datos ";
        }
    
        mysqli_close($conn);
   
    }

    if ($_POST['action'] == 'baja_paciente')
    {
       $id_usuario_baja = $_POST['id_usuario'];

       $query_baja = mysqli_query($conn,"UPDATE usuarios SET estado = 0  WHERE id_usuario = $id_usuario_baja");

       if($query_baja){
           echo "Paciente dado de Baja Correctamente";
       }else{
           echo "Error en la operacion";
       }

    }

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

        $query_insert = mysqli_query($conn,"INSERT INTO usuarios(nombre,apellido,direccion,telefono,dni,correo,fecha_nac,sexo,hijos,tipo_usuario) 
                                            VALUES('$nombre_pac','$apellido_pac','$direccion_pac', '$telefono_pac', '$dni_pac', '$correo_pac','$fecha_nac_pac','$sexo_pac','$hijos_pac',2);"); // tipo usuario es 2 cuando es paciente
        // $resultado = mysqli_fetch_assoc($query_insert);
        if($query_insert){
            echo 'exito';
        }else{
            echo "Error";            
        }
        mysqli_close($conn); 
    }

    if ($_POST['action'] == 'lista_pacientes') 
    {            
        $query_listado_pacientes = mysqli_query($conn,"SELECT u.id_usuario, u.nombre, u.apellido, u.dni, COUNT(p.id_usuario) as cant_planes
                                                        FROM usuarios u LEFT JOIN planes_nutricionales p ON u.id_usuario = p.id_usuario
                                                        WHERE u.tipo_usuario = 2 AND u.estado = 1
                                                        GROUP BY u.nombre,u.apellido,u.dni ");
        $resultado_lista = mysqli_num_rows($query_listado_pacientes);  
    
        $detalleTabla = '';

        if ($resultado_lista > 0) 
        {
            // armado de las filas del detalle de la receta
            while ($datos = mysqli_fetch_assoc($query_listado_pacientes)) 
            {   
                // clasificacion de botones del plan
                
                $botones = "";
                if(intval($datos['cant_planes']) > 0)
                {

                    $botones .= '<button type="button" class="btn btn-outline btn-success"  onclick="imprimir_analisis('.$datos['id_usuario'].');" > Imprimir Evaluacion</button>
                                 <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_sintetica_desarrollada('.');" > Sintetica y Cal</button>
                                 <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_seleccion_preparacion('.');" > Formas y Preparacion</button>
                                 <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_recetario();" > Recetario </button>';

                   
                    $botones .= '<button type="button" class="btn btn-outline btn-success" onclick="imp_p_control('.$datos['id_usuario'].');">Controles</button>';
                   
    
                } 

                $detalleTabla .= '<tr class="odd gradeX">                                    
                                     <td>'.$datos['apellido'].'</td>
                                     <td colspan="2">'.$datos['nombre'].'</td>
                                     <td>'.$datos['dni'].'</td>                                                                 
                                     <td class="center">      
                                     <button type="button" class="btn btn-warning " onclick="editar_paciente('.$datos['id_usuario'].');" data-toggle="modal" data-target="#modal_editar_paciente">
                                                    <i class="fa fa-edit fw "></i> Editar
                                     </button>'.$botones.'
                                       
                                    <button type="button" class="btn btn-outline btn-danger"  onclick="baja_paciente('.$datos['id_usuario'].');" ><i class="fa fa-close"></i> Eliminar</button>
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
                    // clasificacion de botones del plan
                    
                    $botones = "";
                    if(intval($datos['cant_planes']) > 0)
                    {
    
                        $botones .= '<button type="button" class="btn btn-outline btn-success"  onclick="imprimir_analisis('.$datos['id_usuario'].');" > Imprimir Evaluacion</button>
                                     <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_sintetica_desarrollada('.$datos['cant_calorias_plan'].');" > Sintetica y Cal</button>
                                     <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_seleccion_preparacion('.$datos['cant_calorias_plan'].');" > Formas y Preparacion</button>
                                     <button type="button" class="btn btn-outline btn-success"  onclick="imprimir_recetario();" > Recetario </button>';
    
                        if(intval($datos['cant_consultas']) >= 2)
                        {
                            $botones .= '<button type="button" class="btn btn-outline btn-success" onclick="imp_p_control('.$datos['id_usuario'].');">Controles</button>';
                        }
        
                    }
    
                    $detalleTabla .= '<tr class="odd gradeX">                                    
                                         <td>'.$datos['apellido'].'</td>
                                         <td colspan="2">'.$datos['nombre'].'</td>
                                         <td>'.$datos['dni'].'</td>                                                                 
                                         <td class="center">      
                                         <button type="button" class="btn btn-warning " onclick="editar_paciente('.$datos['id_usuario'].');" data-toggle="modal" data-target="#modal_editar_paciente">
                                                        <i class="fa fa-edit fw "></i> Editar
                                         </button>'.$botones.'
                                           
                                        <button type="button" class="btn btn-outline btn-danger"  onclick="baja_paciente('.$datos['id_usuario'].');" ><i class="fa fa-close"></i> Eliminar</button>
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