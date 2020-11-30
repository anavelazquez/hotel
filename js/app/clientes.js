var table_clientes = $('#data-table-simple').dataTable({             
    "paging": true,         
    "ajax": "http://" + usourl + "/php/clientes.func.php?job=get_clientes", 
    "columns": [      
        { "data": "id_cliente" },
        { "data": "nombre_completo" },
        { "data": "fecha_registro" },
        { "data": "functions" }
    ],
    "aoColumnDefs": [
      { "bSortable": false, "aTargets": [-1] }
    ],
    "lengthMenu": [[4, 10, 25, 50, 100, -1], [4, 10, 25, 50, 100, "Todos"]],
    "oLanguage": {
      "sSearch":         "Buscador:",
      "oPaginate": {
        "sFirst":       "Primero",
        "sPrevious":    "Anterior",
        "sNext":        "Siguiente",
        "sLast":        "Último",
      },
      "sLengthMenu":    "Mostrar _MENU_ ",
      "sInfo":          "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
      "sInfoFiltered":  "(filtrado de un total de _MAX_ registros)"
    }
  });

var validatorClientes = $("#form-clientes").validate({
    rules: {
        txtNombre: {
            required: true                
        },
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


$( "#btnAgregar" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalActualiza").modal();        
    validatorClientes.resetForm();
    $('#form-clientes')[0].reset();
});

$(document).on('click', '.function_edit', function(e){  
    e.preventDefault();        
    sessionStorage.setItem("accion","editar");
    $("#modalActualiza").modal();
    sessionStorage.setItem("idcliente",$(this).data("idcliente"));
    sessionStorage.setItem("idusuario",$(this).data("idusuario"));
    $("#txtNombre").val($(this).data("nombre"));
    $("#txtPrimerApellido").val($(this).data("primer_apellido"));
    $("#txtSegundoApellido").val($(this).data("segundo_apellido"));
    $("#txtUsername").val($(this).data("username"));
});

$(document).on('click', '.function_delete', function(e){  
    let idcliente = $(this).data("idcliente");
    e.preventDefault();        
    swal({   title: "¿Está seguro que desea eliminar el cliente?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0053A0",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        closeOnCancel: false },
        function(isConfirm){
            if (isConfirm) {                                                                 
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/clientes.func.php?job=delete_cliente&id='+idcliente+'&id_usuario='+sessionStorage.getItem("idusuario"),
                    cache:        false,                        
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'
                });
                request.done(function(output){
                    if (output.result == 'success'){                            
                        swal({
                            title: "El cliente se eliminó correctamente",                                
                            type: "success"
                            },
                            function(){                                                                       
                                window.location = "clientes.php";
                        });                            
                    } else {                            
                        swal("Error", "No se pudo realizar la acción", "error");
                    }
                });
            } else {
                swal("Cancelado", "No se realizó ninguna acción", "error");
            }
    });  
});


$( "#btnGuardar" ).click(function() {        
    if ($("#form-clientes").valid()) {                    
        swal({   title: "¿Está seguro que desea guardar?",
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#0053A0",
        confirmButtonText: "SI",
        cancelButtonText: "NO",
        closeOnConfirm: false,
        showLoaderOnConfirm: true,
        closeOnCancel: false },
        function(isConfirm){
            if (isConfirm) {    
                var accion_cat;     
                if (sessionStorage.getItem("accion") == "nuevo") {
                    accion_cat = "add_cliente";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_cliente";
                }
                var form_data = "txtNombre="+$("#txtNombre").val()+"&txtPrimerApellido="+$("#txtPrimerApellido").val()+"&txtSegundoApellido="+$("#txtSegundoApellido").val()+"&txtUsername="+$("#txtUsername").val()+"&txtPassword="+$("#txtPassword").val();
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/clientes.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idcliente")+'&id_usuario='+sessionStorage.getItem("idusuario"),
                    cache:        false,       
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'                 
                });
                request.done(function(output){
                    if (output.result == 'success'){                            
                        swal({
                            title: "Los cambios fueron guardados correctamente",                                
                            type: "success"
                            },
                            function(){                                                                       
                                window.location = "clientes.php";
                        });                            
                    } else {                            
                        swal("Error", "No se pudo realizar la acción", "error");
                    }
                });
            } else {
                swal("Cancelado", "No se realizó ninguna acción", "error");
            }
        });        
    }    
});