<?php
    
    // inclucion de archivo de conexion e inicio de session
    require_once('../../../conexion.php');
    session_start();

    if(!empty($_REQUEST['id_usuario'])){   

        $id_usuario = $_REQUEST['id_usuario'];
        
        $query_consulta_controles = mysqli_query($conn,"CALL consulta_controles($id_usuario);");
        $result = mysqli_num_rows($query_consulta_controles);
        $tabla = "";
        if($result >= 2)
        {
            while ($datos = mysqli_fetch_assoc($query_consulta_controles)) 
            {
                $nombre = $datos['nombre'];
                $apellido = $datos['apellido'];
                $edad_actual = $datos['edad_actual'];
                $talla_cm = $datos['talla'];
                $talla_mt = $talla_cm/100; 
                $tabla .= '<tr>                                    
                            <td>'.$datos['fecha'].'</td>
                            <td>'.$talla_mt.'</td>
                            <td>'.$datos['peso'].'</td>                            
                            <td>'.$datos['imc'].'</td>
                            <td>'.$datos['circ_cintura'].'</td>
                            <td>'.$datos['circ_cadera'].'</td>
                            <td>'.$datos['masa_muscular'].'</td>
                            <td>'.$datos['masa_grasa'].'</td>
                            <td>'.$datos['grasa_visceral'].'</td>                                                                 
                        </tr>';
            } 
        }else{
            echo "sin datos para mostrar";
        }

    }else{
        echo "Error al Imprimir";
    }

    
    ob_start();
?>   

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Evaluacion</title>
    <style>
    
    *{
        margin: 0;
        box-sizing: border-box;
    }

    .contenedor_principal{
        width: 90%;
        margin: 0 auto;

    }

    .fuente {
        font-size: 130%;
    }
    
    .contenedor_informacion{
        width: 90%;
        margin: 10 auto;
        position: relative;
        left: 20px;
    }
    .body{
        border : solid;
    }

    .titulo {
        
        display: center;
        width: 90%;
        margin: 0 auto;
        text-align: center;
        text-decoration: underline black;
    }
    .sub_titulo{
        text-decoration: underline black;
    }
    .detalles{
        display: left;
        width: 95%;        
        text-align: center;
    }
    .bold {
        font-weight: bold;
    }

    table, th, td{
        border: 1px solid black;      
        border-collapse: collapse;

    }
    th{
        width: 100px;
        height: 40px;
        text-align:center; 
    }
    td{
        width: 20px;
        text-align:center;
        height: 40px;
    }
    

    

    </style>

</head>


<body class="body contenedor_principal">
       
        <br><br>
        <center><h1> Seguimiento y Control de la Evolucion Cronologica </h1></center>
        <br><br> <br>
        <div class="linea contenedor_informacion fuente">
        <span class="bold"><h2>Paciente:  </h2><br>
        <span class="bold">> Apellido y Nombres:   </span><span><?php  echo $apellido." ".$nombre.".";?></span><br>
        <span class="bold">> Edad Actual :   </span><span><?php  echo $edad_actual."  Años.";?></span>    
        </div><br><br>
        
        <table class=" contenedor_informacion fuente solid">
            
            <tr>
                <th>Fecha </th>
                <th>talla (M)</th>
                <th>Peso (Kg)</th>
                <th> IMC </th>
                <th>C. Cintura (CM)</th>
                <th>C. Cadera (CM)</th>
                <th>% Masa Muscular</th>
                <th>% Masa Grasa </th>
                <th>% Grasa Visceral</th>
            </tr>
            <?php echo $tabla; ?>

        </table><br><br>       
    
</body>
</html>



<?php 
    
      $hoja_1 = ob_get_clean();

    // include autoloader
    require_once 'dompdf/autoload.inc.php';

    // reference the Dompdf namespace
    use Dompdf\Dompdf;

    $dompdf = new Dompdf();
    $options = $dompdf->getOptions();
    $options->setDefaultFont('Courier');
    $dompdf->setOptions($options);

    // instantiate and use the dompdf class
    $dompdf->loadHtml($hoja_1);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4','landscape');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("datos_evaluacion.pdf", array("Attachment" => false));

    
?>
