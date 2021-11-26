
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
                if (response != 'error') 
                {   
                    

                    //bloqueo de campos
                    $('#nombre_pac').attr('disabled','disabled');
                    $('#apellido_pac').attr('disabled','disabled');
                    $('#dni_pac').attr('disabled','disabled');
                    $('#fecha_nac_pac').attr('disabled','disabled');
                    $('#sexo_pac').attr('disabled','disabled');
                    $('#correo_pac').attr('disabled','disabled');
                    $('#telefono_pac').attr('disabled','disabled');
                    $('#direccion_pac').attr('disabled','disabled');
                    
                    // OCULTAR BOTON GUARDAR     
                    $('#guardar_nuevo_pac').slideUp(); 
                    
                    listado_pacientes();
                    // notificacion                   
                    alert(response);
                    
                }
            }, 
        });               

    });

     
});// FIN FUNCION READY //////////////////////////////////////////////////////////// 

// BLOQUE DE FUNCIONES 


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