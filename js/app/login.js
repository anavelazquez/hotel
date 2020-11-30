$(document).ready(function(){        

    $("#login-form").validate({
        rules: {
            txtUsuario: {
                required: true                
            },
            txtContrasena: {
                required: true                
            }            
        },        
        errorElement : 'div',
        errorPlacement: function(error, element) {
          var placement = $(element).data('error');
          if (placement) {
            $(placement).append(error)
          } else {
            error.insertAfter(element);
          }
        }        
    });

    $( "#btnIngresar" ).click(function(e) {        
        e.preventDefault();                            
        var usr = $("#txtUsuario").val();
        var pass = $("#txtContrasena").val();        
                                
        if ($("#login-form").valid()) {
        //if (usr != "" || pass != "") {
            var request = $.ajax({
                url:          'http://' + usourl + '/php/login.func.php?job=login',
                cache:        false,
                data:         'txtUsuario='+usr+'&txtContrasena='+pass,
                dataType:     'json',
                contentType:  'application/json; charset=utf-8',
                type:         'get'
            });
            request.done(function(output){    		
                if (output.result == 'success'){	                                                  
                    sessionStorage.setItem("usr", usr);	                    
                    sessionStorage.setItem("idusuario", output.data[0].id_usuario);
                    sessionStorage.setItem("idempleado", output.data[0].fk_id_empleado);     
                    sessionStorage.setItem("esadmin", output.data[0].es_admin);                
                    window.location.href = "dashboard.php";                                            
                } else {                    
                    swal('No se encontraron datos');	        	
                    $("#login-form")[0].reset();                    
                }
            });
            request.fail(function(jqXHR, textStatus){
                alert('Ocurrió un detalle al loguearse');      	  
            });
        } else {
            swal('Ingrese los datos requeridos');      	  
        }                 
    });        

    $( document ).ajaxStart(function() {
        $("#div_carga").show();
        $("#fondo").hide();
        $("#contenedor").hide();
	});

	$( document ).ajaxStop(function() {
        $("#div_carga").hide();
        $("#fondo").show();
        $("#contenedor").show();
    });	
    
});