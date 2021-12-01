
$(document).ready(function(){       

    $('#buscar_paciente').keyup(function(e) {
        /* Act on the event */
        e.preventDefault(); 

        var buscar = $('#buscar_paciente').val();
        var action = 'buscar_paciente';

        var caracteres = buscar.length;

        if(caracteres >= 3){

            $.ajax({
                url: 'ajax.php',
                type: 'POST',
                async: true,
                data:{action:action, buscar:buscar},

                success: function(response){
                     
                    if (response != '') {
                    
                        var info = JSON.parse(response);
                    
                        $('#listado_pacientes_lista').html('');
                        $('#listado_pacientes_lista').html(info);       
                    }         
                }, 
            }); 
        }
        
        
       /*
    */    

    });


    $('#form_add_paciente').submit(function(e) {
        /* Act on the event */
        e.preventDefault(); 
        
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: $('#form_add_paciente').serialize(),

            success: function(response){

                console.log(response);

                
                if (response != 'error') 
                {   
                    var info = JSON.parse(response);
                    //console.log(info);
                    //bloqueo de campos
                    $('#nombre_pac').attr('disabled','disabled');
                    $('#apellido_pac').attr('disabled','disabled');
                    $('#dni_pac').attr('disabled','disabled');
                    $('#fecha_nac_pac').attr('disabled','disabled');
                    $('#sexo_pac').attr('disabled','disabled');
                    $('#correo_pac').attr('disabled','disabled');
                    $('#telefono_pac').attr('disabled','disabled');
                    $('#direccion_pac').attr('disabled','disabled');
                    $('#hijos_pac').attr('disabled','disabled');

                    $('#id_usuario').val(info.id_user);
                    
                    // OCULTAR BOTON GUARDAR     
                    $('#guardar_nuevo_pac').slideUp(); 
                    
                    listado_pacientes();
                    // notificacion                   
                    alert('Paciente Guardado Exitosamente! ');
                    
                } 
            }, 
        });               

    });

    $('#form_antropometria').submit(function(e) {
        /* Act on the event */
        e.preventDefault(); 

        var myform = $('#form_antropometria');

        // Find disabled inputs, and remove the "disabled" attribute
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        // serialize the form
        var formulario_serializado = myform.serialize();

        // re-disabled the set of inputs that you previously enabled
        disabled.attr('disabled','disabled');

        
        
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: formulario_serializado,

            success: function(response){

                alert(response);
                $('#form_antropometria *').prop('readonly', true); 
                $('#guardar_antropometria').slideUp();
                calcular_indices_de_peso();              
            }, 
        });              

    });
    
    

    $('#form_requerimientos_energeticos').submit(function(e) {
        /* Act on the event */
        e.preventDefault(); 

        var myform = $('#form_requerimientos_energeticos');

        // Find disabled inputs, and remove the "disabled" attribute
        var disabled = myform.find(':input:disabled').removeAttr('disabled');

        // serialize the form
        var formulario_serializado = myform.serialize();

        // re-disabled the set of inputs that you previously enabled
        disabled.attr('disabled','disabled');
         
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: formulario_serializado,
              
            success: function(response){                
                
                alert(response);
                 
                $('#form_requerimientos_energeticos *').prop('readonly', true); 
                $('#guardar_req_energeticos').slideUp();
                $('#lista_indices').prop('disabled', true);
                $('#factor_actividad').prop('disabled', true);
                $('#total_cal_plan').prop('disabled', true);
                
                
                        
            },   
        });              

    });
     
});// FIN FUNCION READY //////////////////////////////////////////////////////////// 

// BLOQUE DE FUNCIONES 

function calcular_RED(){

    var f_actividad = $('#factor_actividad').val();
   
    var gasto_e_basal = $('#gasto_energetico_basal').val();


    if(isNaN(f_actividad)){  // si no es numerico      
        $('#gasto_e_total').val('');
    }else{ // si es numerico
        var factor_actividad = gasto_e_basal * f_actividad;
        $('#gasto_e_total').val(Math.round( parseInt(gasto_e_basal) + parseInt(factor_actividad)));
    }
    
}

function calcular_gasto_e_basal(){

    var indice_peso = $('#lista_indices').val();
    var sexo  = $('#sexo_pac').val();
    
    var factor_sexo;
    if(sexo == 'M'){// si es varon
        factor_sexo = 1;
    }else{ // si es mujer
        factor_sexo = 0.95;
    }
    
    var peso;
    if(indice_peso == 1){
         peso = $('#peso_ideal').val();
    }else if(indice_peso == 2){
         peso = $('#peso_ideal_corregido').val();
    }else if(indice_peso == 3){
         peso = $('#peso_actual_RE').val();
    }else{
        $('#gasto_energetico_basal').val('');
    }

    $('#gasto_energetico_basal').val(Math.round(factor_sexo * peso * 24)); 

}

function calcular_indices_de_peso(){
    
    var peso_actual = $('#peso_pac').val();
    var sexo  = $('#sexo_pac').val();
    var talla_cm  = $('#talla_pac').val();

    $('#peso_actual_RE').val(peso_actual);

    //calculo peso ideal 
    var aux = (talla_cm - 100);
    var peso_ideal =  aux - ((aux*10)/100);

    var peso_ideal_corregido = ((peso_actual - peso_ideal) * 0.25) + peso_ideal;
    
    peso_ideal = peso_ideal.toFixed(2);
    $('#peso_ideal').val(peso_ideal);
    $('#rango_peso_ideal').val((peso_ideal - 5)+' - '+(peso_ideal + 5));
    $('#peso_ideal_corregido').val(peso_ideal_corregido);
    
    if(sexo == 'M') // si es varon
    {
        $('#sexo_RE').val('Masculino');
        
    }else{ // si es mujer 
        $('#sexo_RE').val('Femenino');
    }


}

function clasificacion_grasa_v(){
    
    // datos para la operacion
    
    var grasa_visceral= $('#g_visceral_pac').val();     
    var clasif_g_visceral;

    if(grasa_visceral != 0 && grasa_visceral != '')
    {
        if(grasa_visceral <= 9)
        {
            clasif_g_visceral = "Bajo";
        }else if(grasa_visceral >= 10 && grasa_visceral <= 14)
        {
            clasif_g_visceral = "Normal";
        }else if(grasa_visceral >= 15 )
        {
            clasif_g_visceral = "Elevado";
        }

        $('#clasif_g_visceral').val(clasif_g_visceral);

    }else{
        $('#clasif_g_visceral').val('');
    } 
}

function clasificacion_masa_grasa(){
    
    // datos para la operacion
    var sexo_pac = $('#sexo_pac').val();
    var masa_grasa = $('#masa_grasa_pac').val(); 
    var edad_actual = $('#edad_actual').val();
    var clasif_m_grasa;

    if(sexo_pac != '' && masa_grasa != '' && masa_grasa != 0 && edad_actual != '' && edad_actual != 0)
    {
        if(sexo_pac == 'M') // si es varon
        {
            if(edad_actual >=20 && edad_actual <=39 )
            {
                if(masa_grasa < 8)
                {
                    clasif_m_grasa = "Bajo";
                }else if(masa_grasa >= 8 && masa_grasa <= 19.9)
                {
                    clasif_m_grasa = "Normal";
                }else if(masa_grasa >= 20 && masa_grasa <= 24.9)
                {
                    clasif_m_grasa = "Elevado";
                }else if(masa_grasa >= 25)
                {
                    clasif_m_grasa = "Muy Elevado";
                }


            }else if(edad_actual >=40 && edad_actual <=59 )            
            {
                if(masa_grasa < 11){
                    clasif_m_grasa = "Bajo";

                }else if(masa_grasa >= 11 && masa_grasa <= 21.9){
                    clasif_m_grasa = "Normal";

                }else if(masa_grasa >= 22 && masa_grasa <= 27.9){
                    clasif_m_grasa = "Elevado";

                }else if(masa_grasa >= 28){
                    clasif_m_grasa = "Muy Elevado";
                }

            }else if(edad_actual >= 60 && edad_actual <= 79 )
            {
                if(masa_grasa < 13)
                {
                    clasif_m_grasa = "Bajo";
                }else if(masa_grasa >= 13 && masa_grasa <= 24.9)
                {
                    clasif_m_grasa = "Normal";
                }else if(masa_grasa >= 25 && masa_grasa <= 29.9)
                {
                    clasif_m_grasa = "Elevado";
                }else if(masa_grasa >= 30)
                {
                    clasif_m_grasa = "Muy Elevado";
                }
            }
        }else{ // si es mujer
            if(edad_actual >= 20 && edad_actual <=39 )
            {
                if(masa_grasa < 21)
                {
                    clasif_m_grasa = "Bajo";
                }else if(masa_grasa >= 21 && masa_grasa <= 32.9)
                {
                    clasif_m_grasa = "Normal";
                }else if(masa_grasa >= 33 && masa_grasa <= 38.9)
                {
                    clasif_m_grasa = "Elevado";
                }else if(masa_grasa >= 39)
                {
                    clasif_m_grasa = "Muy Elevado";
                }


            }else if(edad_actual >=40 && edad_actual <=59 )            
            {
                if(masa_grasa < 23)
                {
                    clasif_m_grasa = "Bajo";
                }else if(masa_grasa >= 23 && masa_grasa <= 33.9)
                {
                    clasif_m_grasa = "Normal";
                }else if(masa_grasa >= 34 && masa_grasa <= 39.9)
                {
                    clasif_m_grasa = "Elevado";
                }else if(masa_grasa >= 40)
                {
                    clasif_m_grasa = "Muy Elevado";
                }

            }else if(edad_actual >= 60 && edad_actual <= 79 )
            {
                if(masa_grasa < 24)
                {
                    clasif_m_grasa = "Bajo";
                }else if(masa_grasa >= 24 && masa_grasa <= 35.9)
                {
                    clasif_m_grasa = "Normal";
                }else if(masa_grasa >= 36 && masa_grasa <= 41.9)
                {
                    clasif_m_grasa = "Elevado";
                }else if(masa_grasa >= 42)
                {
                    clasif_m_grasa = "Muy Elevado";
                }
            }
        }

        // fuente: Basado en las pautas sobre el IMC de NIH/OMS. 
        $('#clasif_masa_grasa').val(clasif_m_grasa);
        

    }else{
        
        $('#clasif_masa_grasa').val('');
    }
    
    
}

function clasif_masa_muscular(){
    
    // datos para la operacion
    var sexo_pac = $('#sexo_pac').val();
    var masa_muscular = $('#masa_musc_pac').val(); 
    var edad_actual = $('#edad_actual').val();
    var clasif_m_muscular;

    if(sexo_pac != '' && masa_muscular != '' && masa_muscular != 0 && edad_actual != '' && edad_actual != 0)
    {
        if(sexo_pac == 'M') // si es varon
        {
            if(edad_actual >=18 && edad_actual <=39 )
            {
                if(masa_muscular < 33.3)
                {
                    clasif_m_muscular = "Bajo";
                }else if(masa_muscular >= 33.3 && masa_muscular <=39.3)
                {
                    clasif_m_muscular = "Normal";
                }else if(masa_muscular >= 39.4 && masa_muscular <= 44)
                {
                    clasif_m_muscular = "Elevado";
                }else if(masa_muscular > 44)
                {
                    clasif_m_muscular = "Muy Elevado";
                }


            }else if(edad_actual >=40 && edad_actual <=59 )            
            {
                if(masa_muscular < 33.1){
                    clasif_m_muscular = "Bajo";

                }else if(masa_muscular >= 33.1 && masa_muscular <=39.1){
                    clasif_m_muscular = "Normal";

                }else if(masa_muscular >= 39.2 && masa_muscular <= 43.8){
                    clasif_m_muscular = "Elevado";

                }else if(masa_muscular >= 43.9){
                    clasif_m_muscular = "Muy Elevado";
                }

            }else if(edad_actual >=60 && edad_actual <=80 )
            {
                if(masa_muscular < 32.9)
                {
                    clasif_m_muscular = "Bajo";
                }else if(masa_muscular >= 32.9 && masa_muscular <=38.9)
                {
                    clasif_m_muscular = "Normal";
                }else if(masa_muscular >= 39 && masa_muscular <= 43.6)
                {
                    clasif_m_muscular = "Elevado";
                }else if(masa_muscular >= 43.7)
                {
                    clasif_m_muscular = "Muy Elevado";
                }
            }
        }else{ // si es mujer
            if(edad_actual >=18 && edad_actual <=39 )
            {
                if(masa_muscular < 24.3)
                {
                    clasif_m_muscular = "Bajo";
                }else if(masa_muscular >= 24.3 && masa_muscular <=30.3)
                {
                    clasif_m_muscular = "Normal";
                }else if(masa_muscular >= 30.4 && masa_muscular <= 35.3)
                {
                    clasif_m_muscular = "Elevado";
                }else if(masa_muscular >= 35.4)
                {
                    clasif_m_muscular = "Muy Elevado";
                }


            }else if(edad_actual >=40 && edad_actual <=59 )            
            {
                if(masa_muscular < 24.1)
                {
                    clasif_m_muscular = "Bajo";
                }else if(masa_muscular >= 24.1 && masa_muscular <=30.1)
                {
                    clasif_m_muscular = "Normal";
                }else if(masa_muscular >= 30.2 && masa_muscular <= 35.1)
                {
                    clasif_m_muscular = "Elevado";
                }else if(masa_muscular >= 35.2)
                {
                    clasif_m_muscular = "Muy Elevado";
                }

            }else if(edad_actual >=60 && edad_actual <=80 )
            {
                if(masa_muscular < 23.9)
                {
                    clasif_m_muscular = "Bajo";
                }else if(masa_muscular >= 23.9 && masa_muscular <=29.9)
                {
                    clasif_m_muscular = "Normal";
                }else if(masa_muscular >= 30 && masa_muscular <= 34.9)
                {
                    clasif_m_muscular = "Elevado";
                }else if(masa_muscular >= 35)
                {
                    clasif_m_muscular = "Muy Elevado";
                }
            }
        }

        // fuente: Omron Healthcare
        $('#clasif_masa_musc').val(clasif_m_muscular);
        

    }else{
        $('#clasif_masa_musc').val('');
    }
    
    
}

function clasif_cintura(){

    var sexo_pac = $('#sexo_pac').val();
    var clasif_cintura;
    if(sexo_pac != '')
    {        
        var c_cintura = $('#c_cintura_pac').val();        
        if(c_cintura != '' && c_cintura > 60)
        {
            if(sexo_pac == 'M') // si es varon
            {
                if(c_cintura < 94)
                {
                    clasif_cintura = "Bajo";
                }else if(c_cintura >= 94 && c_cintura <= 102){
                    clasif_cintura = "Aumentado";
                }else if(c_cintura > 102){
                    clasif_cintura = "Muy Aumentado";
                }

            }else{ // si es mujer 

                if(c_cintura < 80)
                {
                    clasif_cintura = "Bajo";
                }else if(c_cintura >= 80 && c_cintura <= 88){
                    clasif_cintura = "Aumentado";
                }else if(c_cintura > 88){
                    clasif_cintura = "Muy Aumentado";
                }                
            }
            // fuente: grado de riesgo metabolico establecido por la OMS en 1998.
            $('#clasif_cintura_pac').val(clasif_cintura);
            
        }else{
            $('#clasif_cintura_pac').val('');
        }        
    }else{
        $('#clasif_cintura_pac').val('');
    }
    
}

function calculo_imc(){
    
    var peso_pac = $('#peso_pac').val();
    var talla_pac = $('#talla_pac').val();

    if(peso_pac != 0 && talla_pac != 0)
    {
        talla_pac = talla_pac/100;
        var imc_pac = peso_pac / (talla_pac * talla_pac);
        imc_pac = imc_pac.toFixed(2);
        //console.log(peso_pac,talla_pac,imc_pac);
        var clasificacion_imc;
        if(imc_pac < 18.5){
            clasificacion_imc ="Delgadez o Bajo Peso";
        }else if(imc_pac >= 18.5 && imc_pac <= 24.9){
            clasificacion_imc ="Peso Normal o Saludable";
        }else if(imc_pac >= 25 && imc_pac <= 29.9){
            clasificacion_imc ="Sobrepeso";
        }else if(imc_pac >= 30 && imc_pac <= 34.9){
            clasificacion_imc ="Obesidad Grado I";
        }else if(imc_pac >= 35 && imc_pac <= 39.9){
            clasificacion_imc ="Obesidad Grado II";
        }else if(imc_pac >= 40){
           clasificacion_imc ="Obesidad Grado III";
        }

        // Fuente: OMS 1998.

        $('#imc_pac').val(imc_pac);
        $('#clasif_imc_pac').val(clasificacion_imc);

    }else{
        $('#imc_pac').val('');
        $('#clasif_imc_pac').val('');
    }
   

}

function añadir_paciente_plan(id_paciente){
    
    // nota, este id_paciente hace referencia al ID de Usuario, de la tabla usuarios
    var id_paciente = id_paciente;    
    action = 'info_paciente';


    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_paciente:id_paciente},    
        
        success: function (response) {

            var info = JSON.parse(response);
            //console.log(info);

            // mostrar datos en el formulario
            $('#nombre_pac').val(info.nombre);
            $('#apellido_pac').val(info.apellido);
            $('#dni_pac').val(info.dni);
            $('#fecha_nac_pac').val(info.fecha_nac);
            $('#sexo_pac').val(info.sexo);
            $('#correo_pac').val(info.correo);
            $('#telefono_pac').val(info.telefono);
            $('#direccion_pac').val(info.direccion);
            $('#hijos_pac').val(info.hijos);
            $('#id_usuario').val(id_paciente);
            $('#id_paciente_red').val(id_paciente);            
            $('#edad_actual').val(info.edad); 
            $('#id_paciente_antropometria').val(info.id_paciente);
            
            // OCULTAR BOTON GUARDAR     
            $('#guardar_nuevo_pac').slideUp(); 

            // bloquear campos 
            $('#nombre_pac').attr('disabled','disabled');
            $('#apellido_pac').attr('disabled','disabled');
            $('#dni_pac').attr('disabled','disabled');
            $('#fecha_nac_pac').attr('disabled','disabled');
            $('#sexo_pac').attr('disabled','disabled');
            $('#correo_pac').attr('disabled','disabled');
            $('#telefono_pac').attr('disabled','disabled');
            $('#direccion_pac').attr('disabled','disabled');
            $('#hijos_pac').attr('disabled','disabled');
            
           
            
            cerrar_modal_buscar_paciente();
        }, 
    });

}

function listado_pacientes(){

    var action = 'lista_pacientes';
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action},    
        
        success: function (response) {

            if (response != '') {
                
                var info = JSON.parse(response);
               
                $('#listado_pacientes_lista').html('');
                $('#listado_pacientes_lista').html(info);
                

            } 
        },
    });
}

function cerrar_modal_buscar_paciente(){
    $("#modal_buscar_paciente").modal('hide');//ocultamos el modal
    $('body').removeClass('modal-open');//eliminamos la clase del body para poder hacer scroll
    $('.modal-backdrop').remove();//eliminamos el backdrop del modal
  }

function limpiar_modal_add_paciente(){    
    $('#nombre_pac').removeAttr('disabled');
    $('#apellido_pac').removeAttr('disabled');
    $('#dni_pac').removeAttr('disabled');
    $('#fecha_nac_pac').removeAttr('disabled');
    $('#sexo_pac').removeAttr('disabled');
    $('#correo_pac').removeAttr('disabled');
    $('#telefono_pac').removeAttr('disabled');
    $('#direccion_pac').removeAttr('disabled');

    $('#nombre_pac').val('');
    $('#apellido_pac').val('');
    $('#dni_pac').val('');
    $('#fecha_nac_pac').val('');
    $('#sexo_pac').val('');
    $('#correo_pac').val('');
    $('#telefono_pac').val('');
    $('#direccion_pac').val('');
    $('#guardar_nuevo_pac').slideDown();
}
