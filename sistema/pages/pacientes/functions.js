
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

                    $('#panel_add_pac').slideUp();
                    $('#ocultar_form_addPac').hide();
                    $('#mostrar_form_add_pac').show();
                    limpiar_formulario_alta();
                    
                } 
            }, 
        });               

    });

    $('#form_editar_paciente').submit(function(e) {
        /* Act on the event */
        e.preventDefault(); 
        
        $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: $('#form_editar_paciente').serialize(),

            success: function(response){
                alert(response);
                listado_pacientes();
            }, 
        });               

    });

    $('#ocultar_form_addPac').click(function(e){
        $('#panel_add_pac').slideUp();
        $('#ocultar_form_addPac').hide();
        $('#mostrar_form_add_pac').show();
    })

    $('#mostrar_form_add_pac').click(function(e){
        $('#panel_add_pac').slideDown();
        $('#ocultar_form_addPac').show();
        $('#mostrar_form_add_pac').hide();
        
    })
     
});// FIN FUNCION READY //////////////////////////////////////////////////////////// 

// BLOQUE DE FUNCIONES 

function imp_p_control(id_usuario){
    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = '../pdf/planilla_control.php?id_usuario='+id_usuario;
    window.open($url,"Evaluacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    
}



function imprimir_recetario(){

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = '../pdf/recetas.pdf';
    window.open($url,"Formas y Preparacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    
}

function imprimir_seleccion_preparacion(calorias){

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = '../pdf/planes/'+calorias+'/seleccion_preparacion.pdf';
    window.open($url,"Formas y Preparacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    
}

function imprimir_sintetica_desarrollada(calorias){

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = '../pdf/planes/'+calorias+'/sintetica_y_desarrollada.pdf';
    window.open($url,"Sintetica y desarrollada","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    
}

function imprimir_analisis(id_usuario){

    var ancho = 1000;
    var alto = 800;

    var x = parseInt((window.screen.width/2) - (ancho / 2));
    var y = parseInt((window.screen.height/2) - (alto / 2));

    $url = '../pdf/evaluacion.php?id_usuario='+id_usuario;
    window.open($url,"Evaluacion","left="+x+",top="+y+",height="+alto+",width="+ancho+",scrollbar=si,location=no,resizable=si,menubar=no");
    
}

function editar_paciente(id_usuario){
      
    action = 'info_paciente';

    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data: { action: action, id_usuario:id_usuario},    
        
        success: function (response) {

            var info = JSON.parse(response);
            //console.log(info);

            // mostrar datos en el formulario
            $('#nombre_pac_editar').val(info.nombre);
            $('#apellido_pac_editar').val(info.apellido);
            $('#dni_pac_editar').val(info.dni);
            $('#fecha_nac_pac_editar').val(info.fecha_nac);
            $('#sexo_pac_editar').val(info.sexo);
            $('#correo_pac_editar').val(info.correo);
            $('#telefono_pac_editar').val(info.telefono);
            $('#direccion_pac_editar').val(info.direccion);
            $('#hijos_pac_editar').val(info.hijos);
            $('#id_usuario_editar').val(id_usuario);          
        
        }, 
    });

}

function baja_paciente(id_usuario){

    var action = 'baja_paciente';
    $.ajax({
        url: 'ajax.php',
        type: 'POST',
        async: true,
        data:{action:action, id_usuario:id_usuario},

        success: function(response){

            alert(response);
             
            listado_pacientes();
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
            
            //console.log(response);
            if (response != '') {
                
                var info = JSON.parse(response);
               
                $('#listado_pacientes_lista').html('');
                $('#listado_pacientes_lista').html(info);
                

            } 
        },
    });
}

function limpiar_formulario_alta(){

    $('#nombre_pac').attr('disabled',false);
    $('#apellido_pac').attr('disabled',false);
    $('#dni_pac').attr('disabled',false);
    $('#fecha_nac_pac').attr('disabled',false);
    $('#sexo_pac').attr('disabled',false);
    $('#correo_pac').attr('disabled',false);
    $('#telefono_pac').attr('disabled',false);
    $('#direccion_pac').attr('disabled',false);
    $('#hijos_pac').attr('disabled',false);

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

