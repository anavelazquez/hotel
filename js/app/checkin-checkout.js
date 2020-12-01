var table_checkin_checkout = $('#data-table-simple').dataTable({
    "paging": true,
    "ajax": "http://" + usourl + "/php/checkin-checkout.func.php?job=get_reservaciones_detalle",
    "columns": [
        { "data": "nombre_edificio" },
        { "data": "numero_habitacion" },
        { "data": "nombre_huesped" },
        { "data": "edad_huesped" },
        { "data": "fecha_inicio" },
        { "data": "fecha_fin" },
        { "data": "fecha_reservacion" },
        { "data": "fecha_check_in" },
        { "data": "fecha_check_out" },
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

$(document).on('click', '.function_checkin', function(e){
    e.preventDefault();
    sessionStorage.setItem("accion","check_in");
    $("#modalCheck").modal();
    $("#lblDescModal").html('Registrar Check IN');
    $("#lblFechaHora").html('Fecha/Hora Check IN');
    sessionStorage.setItem("idreservacionhuesped",$(this).data("idreservacionhuesped"));
    $("#txtEdificio").val($(this).data("nombreedificio"));
    $("#txtNoHabitacion").val($(this).data("numerohabitacion"));
    $("#txtNombreHuesped").val($(this).data("nombrehuesped"));
    $("#txtEdad").val($(this).data("edadhuesped"));
});

$(document).on('click', '.function_checkout', function(e){
    e.preventDefault();
    sessionStorage.setItem("accion","check_out");
    $("#modalCheck").modal();
    $("#lblDescModal").html('Registrar Check OUT');
    $("#lblFechaHora").html('Fecha/Hora Check OUT');
    sessionStorage.setItem("idreservacionhuesped",$(this).data("idreservacionhuesped"));
    $("#txtEdificio").val($(this).data("nombreedificio"));
    $("#txtNoHabitacion").val($(this).data("numerohabitacion"));
    $("#txtNombreHuesped").val($(this).data("nombrehuesped"));
    $("#txtEdad").val($(this).data("edadhuesped"));

});


$( "#btnGuardar" ).click(function() {
    if ($("#form-checkin-checkout").valid()) {
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
                if (sessionStorage.getItem("accion") == "check_in") {
                    accion_cat = "check_in";
                } else if (sessionStorage.getItem("accion") == "check_out") {
                    accion_cat = "check_out";
                }

                var form_data = "idreservacionhuesped="+$("#idreservacionhuesped").val()+"&txtControlFechaHoraCheckInOut="+$("#txtControlFechaHoraCheckInOut").val();
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/checkin-checkout.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idreservacionhuesped"),
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