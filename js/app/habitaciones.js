var table_habitaciones = $('#data-table-simple').dataTable({
    "paging": true,
    "ajax": "http://" + usourl + "/php/habitaciones.func.php?job=get_habitaciones",
    "columns": [
        { "data": "id_habitacion" },
        { "data": "nombre_edificio" },
        { "data": "nivel_piso" },
        { "data": "descripcion_tipo_habitacion" },
        { "data": "numero_habitacion" },
        { "data": "descripcion_vista" },
        { "data": "descripcion_estatus_habitacion" },
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

var validatorHabitacion = $("#form-habitaciones").validate({
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

getEdificios();
getTiposHabitacion();
getVistas();
getEstatusHabitacion();

$( "#btnAgregar" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalActualiza").modal();
    validatorHabitacion.resetForm();
    $('#form-habitaciones')[0].reset();
});

$(document).on('click', '.function_edit', function(e){
    e.preventDefault();
    sessionStorage.setItem("accion","editar");
    $("#modalActualiza").modal();
    sessionStorage.setItem("idhabitacion",$(this).data("idhabitacion"));
    $("#slEdificio").val($(this).data("idedificio"));
    $("#txtNivel").val($(this).data("nivelpiso"));
    $("#txtNoHabitacion").val($(this).data("numerohabitacion"));
    $("#slTipoHabitacion").val($(this).data("idtipohabitacion"));
    $("#slVista").val($(this).data("idvista"));
    $("#slEstatusHabitacion").val($(this).data("idestatushabitacion"));
});

$(document).on('click', '.function_delete', function(e){
    let idhabitacion = $(this).data("idhabitacion");
    e.preventDefault();
    swal({   title: "¿Está seguro que desea eliminar la habitación?",
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
                    url:          'http://' + usourl + '/php/habitaciones.func.php?job=delete_habitacion&id='+idhabitacion,
                    cache:        false,
                    dataType:     'json',
                    contentType:  'application/json; charset=utf-8',
                    type:         'get'
                });
                request.done(function(output){
                    if (output.result == 'success'){
                        swal({
                            title: "La habitación se eliminó correctamente",
                            type: "success"
                            },
                            function(){
                                window.location = "habitaciones.php";
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
    if ($("#form-habitaciones").valid()) {
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
                    accion_cat = "add_habitacion";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_habitacion";
                }

                var form_data = "slEdificio="+$("#slEdificio").val()+"&txtNivel="+$("#txtNivel").val()+"&txtNoHabitacion="+$("#txtNoHabitacion").val()+"&slTipoHabitacion="+$("#slTipoHabitacion").val()+"&slVista="+$("#slVista").val()+"&slEstatusHabitacion="+$("#slEstatusHabitacion").val();
                var request   = $.ajax({
                    url:          'http://' + usourl + '/php/habitaciones.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idhabitacion"),
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
                                window.location = "habitaciones.php";
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

function getEdificios(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/edificios.func.php?job=get_edificios',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){
    if (output.result == 'success'){
        var dataslEdificios = "<option value='' disabled='' selected=''>Seleccione</option>";
        for (i = 0; i < output.data.length; ++i) {
            dataslEdificios += "<option value='" + output.data[i].id_edificio +"'>" + output.data[i].nombre_edificio + "</option>";
        }
        $("#slEdificio").html(dataslEdificios);
    } else {
        alert('Add request failed');
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);
    });
}

function getTiposHabitacion(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/tipos-habitacion.func.php?job=get_tipos_habitacion',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){
    if (output.result == 'success'){
        var dataslTiposHabitacion = "<option value='' disabled='' selected=''>Seleccione</option>";
        for (i = 0; i < output.data.length; ++i) {
            dataslTiposHabitacion += "<option value='" + output.data[i].id_tipo_habitacion +"'>" + output.data[i].descripcion_tipo_habitacion + "</option>";
        }
        $("#slTipoHabitacion").html(dataslTiposHabitacion);
    } else {
        alert('Add request failed');
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);
    });
}

function getVistas(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/vistas.func.php?job=get_vistas',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){
    if (output.result == 'success'){
        var dataslVistas = "<option value='' disabled='' selected=''>Seleccione</option>";
        for (i = 0; i < output.data.length; ++i) {
            dataslVistas += "<option value='" + output.data[i].id_vista +"'>" + output.data[i].descripcion_vista + "</option>";
        }
        $("#slVista").html(dataslVistas);
    } else {
        alert('Add request failed');
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);
    });
}

function getEstatusHabitacion(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/estatus-habitacion.func.php?job=get_estatus_habitacion',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){
    if (output.result == 'success'){
        var dataslEstatus = "<option value='' disabled='' selected=''>Seleccione</option>";
        for (i = 0; i < output.data.length; ++i) {
            dataslEstatus += "<option value='" + output.data[i].id_estatus_habitacion +"'>" + output.data[i].descripcion_estatus_habitacion + "</option>";
        }
        $("#slEstatusHabitacion").html(dataslEstatus);
    } else {
        alert('Add request failed');
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);
    });
}