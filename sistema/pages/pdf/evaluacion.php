<?php
    
    // inclucion de archivo de conexion e inicio de session
    require_once('../../../conexion.php');
    session_start();

    if(!empty($_REQUEST['id_usuario'])){   

        $id_usuario = $_REQUEST['id_usuario'];
     

        $query_info_consulta = mysqli_query($conn,"SELECT * FROM planes_nutricionales pn
                                                    INNER JOIN consultas c ON pn.id_plan = c.id_plan 
                                                    LEFT JOIN usuarios u ON pn.id_usuario = u.id_usuario
                                                    WHERE pn.id_usuario = $id_usuario;");
        $result = mysqli_fetch_assoc($query_info_consulta);
       
        
       
        $nombre = $result['nombre'];
        $apellido = $result['apellido'];
        $sexo_char = $result['sexo'];

        if($sexo_char == 'M'){
            $sexo_desc = "Masculino";
        }else{
            $sexo_desc = "Femenino";
        }

        $peso_actual = $result['peso_actual'];
        $talla = $result['talla_actual'];
        $edad_actual = $result['edad_actual'];
        $circ_cintura = $result['circ_cintura_actual'];
        $c_cintura_clasif = $result['c_cintura_clasif'];
        $circ_cadera = $result['c_cadera'];
        $imc = $result['imc_actual'];
        $imc_clasificacion = $result['imc_clasif'];
        $diagnostico = $result['diagnostico'];
            
        $masa_grasa = $result['masa_grasa'];
        $masa_grasa_clasif = $result['m_grasa_clasif'];
        $masa_muscular = $result['masa_muscular'];
        $masa_musc_clasif = $result['m_muscular_clasif'];
        $grasa_visceral = $result['grasa_visceral'];
        $g_visceral_clasif = $result['g_visceral_clasif'];
        
        $primer_objetivo = 1 - $talla;
          

    }else{
        echo "Error al Imprimir";
    }

    $fecha = getdate(); 
    $dia = $fecha['mday'];
    $mes = $fecha['mon'];
    $año = $fecha['year'];
    
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

    .fecha{
        float:right;
    }

    </style>

</head>


<body class="body contenedor_principal">

<script>
    DameLaFechaHora();
  </script>
        <span class="fecha">Fecha Generacion: <span><?php echo $dia.'/'.$mes.'/'.$año; ?></span></span>
        <br><br>
        <center><h1> Datos y Evaluacion Antropometrica</h1></center>
        <br><br> <br>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Apellido y Nombres: </span><span><?php echo $apellido." ".$nombre.".";?>.</span>
        </div>         
        <div class="linea contenedor_informacion  fuente">
            <span class="bold">> Edad: </span><span><?php echo $edad_actual;?></span><span> años.</span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Talla: </span><span><?php echo ($talla);?></span><span> Cm.</span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Peso Actual: </span><span><?php echo $peso_actual;?></span><span> Kg.</span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Circunferencia de Cintura: </span><span><?php echo $circ_cintura." Cm, Riesgo Metabolico  ".$c_cintura_clasif.".";?></span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Circunferencia de Cadera: </span><span><?php echo $circ_cadera;?></span><span> Cm.</span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Indice De Masa Corporal (IMC): </span><span><?php echo $imc;?></span><span> <?php echo $imc_clasificacion;?></span>
        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> % Masa Muscular: </span><span><?php echo $masa_muscular;?></span><span>  <?php echo $masa_musc_clasif;?> .</span>

        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> % Masa Grasa: </span><span><?php echo $masa_grasa;?></span><span>  <?php echo $masa_grasa_clasif;?>.</span> 

        </div>
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> % Grasa Visceral: </span><span><?php echo $grasa_visceral;?></span><span>  <?php echo $g_visceral_clasif;?>.</span>
        </div>
       
        <div class="linea contenedor_informacion fuente">
            <span class="bold">> Primer Objetivo: </span><span><?php echo $primer_objetivo;?> </span><span>Kg.</span>
        </div>
        <br><br>
        <div class="diagnostico contenedor_informacion fuente">
            <h2 class="sub_titulo">Diagnostico Nutricional</h2><br>
            <p>
               Paciente de Sexo  <?php echo $sexo_desc;?>, de <?php echo $edad_actual;?> años de edad,
               presenta <?php echo $imc_clasificacion;?> segun Indice de Masa Corporal, y segun circunferencia 
               de cintura presenta riesgo Metabolico <?php echo $c_cintura_clasif;?>.                
            </p>
            <br>
            <p>
            <?php echo $diagnostico;?>
            </p>
        </div>
        <br><br><br><br><br>
    
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
    $dompdf->setPaper('A4');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF to Browser
    $dompdf->stream("datos_evaluacion.pdf", array("Attachment" => false));

    
?>
