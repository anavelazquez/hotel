var table_edificios = $('#data-table-simple').dataTable({             
    "paging": true,         
    "ajax": "http://" + usourl + "/php/edificios.func.php?job=get_edificios", 
    "columns": [      
        { "data": "id_edificio" },
        { "data": "nombre_edificio" },
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

var validatorEdificios = $("#form-edificios").validate({
    rules: {
        txtNombreEdificio: {
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
    validatorEdificios.resetForm();
    $('#form-edificios')[0].reset();
});

$(document).on('click', '.function_edit', function(e){  
    e.preventDefault();        
    sessionStorage.setItem("accion","editar");
    $("#modalActualiza").modal();
    sessionStorage.setItem("idedificio",$(this).data("idedificio"));
    $("#txtNombreEdificio").val($(this).data("nombreedificio"));
});

$(document).on('click', '.function_delete', function(e){  
    let idedificio = $(this).data("idedificio");
    e.preventDefault();        
    swal({   title: "¿Está seguro que desea eliminar el edificio?",
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
                    url:          'http://' + usourl + '/php/edificios.func.php?job=delete_edificio&id='+idedificio,
                    cache:        false,                        
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'
                });
                request.done(function(output){
                    if (output.result == 'success'){                            
                        swal({
                            title: "El edificio se eliminó correctamente",                                
                            type: "success"
                            },
                            function(){                                                                       
                                window.location = "edificios.php";
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
    if ($("#form-edificios").valid()) {                    
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
                    accion_cat = "add_edificio";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_edificio";
                }
                var form_data = "txtNombreEdificio="+$("#txtNombreEdificio").val();                                                              
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/edificios.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idedificio"),
                    cache:        false,                        
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'post'
                });
                request.done(function(output){
                    if (output.result == 'success'){                            
                        swal({
                            title: "Los cambios fueron guardados correctamente",                                
                            type: "success"
                            },
                            function(){                                                                       
                                window.location = "edificios.php";
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