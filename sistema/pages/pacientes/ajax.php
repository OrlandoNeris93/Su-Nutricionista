<?php

require_once('../../../conexion.php');

if (!empty($_POST)){


	// ACTUALIZAR DATOS DE LA CUENTA DEL PROFESIONAL.
    if ($_POST['action'] == 'actualizar_datos_cuenta') 
	{
        $id_usuario = $_POST['id_usuario'];
        $usuario_cuenta = $_POST['usuario_cuenta'];
        $clave_cuenta = $_POST['clave_cuenta'];
        
        $query_update = mysqli_query($conn,"CALL actualizar_datos_cuenta_prof($id_usuario, '$usuario_cuenta', '$clave_cuenta');");
        
        if($query_update){
            echo "Datos Actualizados Exitosamente!";
        }else{
            echo "Error al Actualizar los Datos!";            
        }
        mysqli_close($conn);
    }

    	// ACTUALIZAR PERSONALES DEL PROFESIONAL.
        if ($_POST['action'] == 'actualizar_datos_profesional') 
        {            
            $id_usuario    = $_POST["id_usuario"];
            $nombre_prof   = $_POST["nombre_prof"];
            $apellido_prof = $_POST["apellido_prof"];
            $dni_prof      = $_POST["dni_prof"];
            $correo_prof   = $_POST["correo_prof"];
            $telefono_prof = $_POST["telefono_prof"];
            $direccion_prof = $_POST["direccion_prof"];
            $matricula_prof = $_POST["matricula_prof"];
            $titulo_prof    = $_POST["titulo_prof"];
            
            $query_update = mysqli_query($conn,"CALL actualizar_datos_pers_prof($id_usuario, '$nombre_prof', '$apellido_prof', '$dni_prof ', '$correo_prof', '$telefono_prof', '$direccion_prof', '$matricula_prof', '$titulo_prof');");
            
            if($query_update){
                echo "Datos Actualizados Exitosamente!";
            }else{
                echo "Error al Actualizar los Datos!";            
            }
            mysqli_close($conn); 
        }
    

}
?>