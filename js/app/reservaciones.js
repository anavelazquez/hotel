var table_clientes = $('#data-table-simple').dataTable({
    "paging": true,
    "ajax": "http://" + usourl + "/php/reservaciones.func.php?job=get_reservaciones",
    "columns": [
        { "data": "id_reservacion" },
        { "data": "nombre_completo" },
        { "data": "nohab" },
        { "data": "tipohab" },
        { "data": "fecha_inicio" },
        { "data": "fecha_fin" },
        { "data": "monto" },
        { "data": "fecha_reservacion" },
        { "data": "estatus_reserva" },
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

/*var validatorClientes = $("#form-clientes").validate({
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
});*/

getEdificios();
getHabitacion();
getClientes();

$(function () {
    $('#txtFechaLlegada, #txtFechaSalida').datetimepicker({
        format: 'YYYY-MM-DD',
        pickTime: false 
    });
});

$( "#btnAgregar" ).click(function() {
    sessionStorage.setItem("accion","nuevo");
    $("#modalActualiza").modal();
    //validatorClientes.resetForm();
    $('#form-reservacion')[0].reset();
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
    if ($("#form-reservacion").valid()) {
        swal({   title: "¿Está seguro que desea realizar la reservación?",
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
                    accion_cat = "add_reservacion";
                } else if (sessionStorage.getItem("accion") == "editar") {
                    accion_cat = "update_reservacion";
                }
                /*$slEdificio = $_GET['slEdificio'];
                $slHabitacion  = $_GET['slHabitacion'];
                $slCliente  = $_GET['slCliente'];
                $txtControltxtFechaLlegada = $_GET['txtControltxtFechaLlegada'];
                $txtControltxtFechaSalida  = $_GET['txtControltxtFechaSalida'];
                $txtMonto = $_GET['txtMonto'];*/
                var form_data = "slEdificio="+$("#slEdificio").val()+"&slHabitacion="+$("#slHabitacion").val()+"&slCliente="+$("#slCliente").val()+"&txtControltxtFechaLlegada="+$("#txtControltxtFechaLlegada").val()+"&txtControltxtFechaSalida="+$("#txtControltxtFechaSalida").val()+"&txtMonto="+$("#txtMonto").val();
                var request   = $.ajax({
                    //url:          'http://' + usourl + '/php/reservaciones.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idcliente")+'&id_usuario='+sessionStorage.getItem("idusuario"),
                    url:          'http://' + usourl + '/php/reservaciones.func.php?job='+accion_cat+'&'+form_data,
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
                                window.location = "reservaciones.php";
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
        var dataslEdificio = "<option value='' disabled='' selected=''>Seleccione edificio</option>";           			
        for (i = 0; i < output.data.length; ++i) {          												
            dataslEdificio += "<option value='" + output.data[i].id_edificio + "'>" + output.data[i].nombre_edificio + "</option>";
        }
        $("#slEdificio").html(dataslEdificio);                
        $("#slEdificio").combobox();
    } else {
        alert('Add request failed');          
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);       
    });
}

function getHabitacion(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/habitaciones.func.php?job=get_habitaciones',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){        
    if (output.result == 'success'){      
        var dataslHabitacion = "<option value='' disabled='' selected=''>Seleccione habitación</option>";           			
        for (i = 0; i < output.data.length; ++i) {          												
            dataslHabitacion += "<option value='" + output.data[i].id_habitacion + "' data-preciohabitacion='" + output.data[i].precio + "'>" + output.data[i].numero_habitacion + "</option>";
        }
        $("#slHabitacion").html(dataslHabitacion);                
        $("#slHabitacion").combobox();
    } else {
        alert('Add request failed');          
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);       
    });
}

function getClientes(){
    var request   = $.ajax({
    url:          'http://' + usourl + '/php/clientes.func.php?job=get_clientes',
    cache:        false,
    dataType:     'json',
    contentType:  'application/json; charset=utf-8',
    type:         'get'
    });
    request.done(function(output){        
    if (output.result == 'success'){      
        var dataslClientes = "<option value='' disabled='' selected=''>Seleccione cliente</option>";           			
        for (i = 0; i < output.data.length; ++i) {          												
            dataslClientes += "<option value='" + output.data[i].id_cliente + "'>" + output.data[i].nombre_completo + "</option>";
        }
        $("#slCliente").html(dataslClientes);                
        $("#slCliente").combobox();
    } else {
        alert('Add request failed');          
    }
    });
    request.fail(function(jqXHR, textStatus){
        alert('Add request failed: ' + textStatus);       
    });
}