var table_habitaciones = $('#data-table-simple').dataTable({
    "paging": true,
    "ajax": "http://" + usourl + "/php/tipos-habitaciones.func.php?job=get_tipos_habitaciones",
    "columns": [
        { "data": "id_tipo_habitacion" },
        { "data": "descripcion_tipo_habitacion" },
        { "data": "precio" },
        { "data": "capacidad_ninos" },
        { "data": "capacidad_adultos" },
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

var validatorHabitacion = $("#form-tipos-habitaciones").validate({
    rules: {
        slEdificio: { required: true },
        txtNivel: { required: true },
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
    validatorHabitacion.resetForm();
    $('#form-tipos-habitaciones')[0].reset();
});

$(document).on('click', '.function_edit', function(e){
    e.preventDefault();
    sessionStorage.setItem("accion","editar");
    $("#modalActualiza").modal();
    sessionStorage.setItem("idtipohabitacion",$(this).data("idtipohabitacion"));
    $("#txtDescripcion").val($(this).data("descripciontipohabitacion"));
    $("#txtPrecio").val($(this).data("precio"));
    $("#txtCapacidadNinos").val($(this).data("capacidadninos"));
    $("#txtCapacidadAdultos").val($(this).data("capacidadadultos"));
});

$(document).on('click', '.function_delete', function(e){
    let idtipohabitacion = $(this).data("idtipohabitacion");
    e.preventDefault();
    swal({   title: "¿Está seguro que desea eliminar el tipo de habitación?",
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
                    url:          'http://' + usourl + '/php/tipos-habitaciones.func.php?job=delete_tipo_habitacion&id='+idtipohabitacion,
                    cache:        false,
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'
                });
                request.done(function(output){
                    if (output.result == 'success'){
                        swal({
                            title: "El tipo de habitación se eliminó correctamente",
                            type: "success"
                            },
                            function(){
                                window.location = "tipos-habitaciones.php";
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
    if ($("#form-tipos-habitaciones").valid()) {
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
                    accion_cat = "add_tipo_habitacion";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_tipo_habitacion";
                }

                var form_data = "txtDescripcion="+$("#txtDescripcion").val()+"&txtPrecio="+$("#txtPrecio").val()+"&txtCapacidadNinos="+$("#txtCapacidadNinos").val()+"&txtCapacidadAdultos="+$("#txtCapacidadAdultos").val();
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/tipos-habitaciones.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idtipohabitacion"),
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
                                window.location = "tipos-habitaciones.php";
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