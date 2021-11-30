
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
                    console.log(info);
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

     
});// FIN FUNCION READY //////////////////////////////////////////////////////////// 



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
// BLOQUE DE FUNCIONES 

