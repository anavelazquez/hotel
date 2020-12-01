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
itemlist   = $('#itemlist');
$counter    = 0;

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

$(document).keypress(function(e) {
  if ($("#txtEdadHuesped").is(":focus") && (e.keyCode == 13)) {
    if ($("#txtNombreHuesped").val() == "" || $("#txtEdadHuesped").val() == "") {
      swal("Error", "Ingrese todos los datos", "error");
    } else {
        let capacidad_ninos = $("#slHabitacion option:selected").attr("data-capacidadninos");
        let capacidad_adultos = $("#slHabitacion option:selected").attr("data-capacidadadultos");
        let opcion_seleccionada = $("#slHabitacion option:selected").val();
        console.log('opcion_seleccionada ', opcion_seleccionada);
        console.log('capacidad_ninos ', capacidad_ninos);

        ocupacion = contarHuespedes();
        console.log('ocupacion', ocupacion);
        let espacio_ninos = true;
        let espacio_adultos = true;
        if(capacidad_ninos == ocupacion.huespedes_ninos){
            espacio_ninos = false;
        }

        if(capacidad_adultos == ocupacion.huespedes_adultos){
            espacio_adultos = false;
        }

        var i= ++$counter;
        var nombre_huesped   = $("#txtNombreHuesped").val();
        var edad_huesped   = $("#txtEdadHuesped").val();

        if(edad_huesped > 1 && edad_huesped < 12 && espacio_ninos==false || edad_huesped > 12 && espacio_adultos ==false ){
            //No hay espacio
            swal("Alert", "No hay espacio para huéspedes de esa edad", "error");
        }else{
            itemlist.append(
              '<tr class="filashuesped" id="fila-'+i+'">\
                  <td id="nombre_huesped-'+i+'" data-nombrehuesped="'+nombre_huesped+'">'+nombre_huesped+'</td>\
                  <td id="edad_huesped-'+i+'" data-edadhuesped="'+edad_huesped+'">'+edad_huesped+'</td>\
                  <td class="text-center"><a class="btn-remove" href="#"><i class="simple-icon-close"></i></a></td>\
              </tr>'
            );

            $("#txtNombreHuesped").val("");
            $("#txtEdadHuesped").val("");
            $("#txtNombreHuesped").focus();
        }

        var contfila = 1;
        $.each( $( ".consecutivo" ), function() {
            var n = $(this).attr('id').match(/\d+/g);
            $("#txtNo"+n).val(contfila);
            contfila++;
        });

    }

  }
});

$('#slHabitacion').on('change', function() {
    $("#txtControltxtFechaHoraCita").blur();
});

$('#itemlist').on('click', '.btn-remove', function(){
  $(this).parent().parent().remove();
});

$( "#btnGuardar" ).click(function() {
    getHuespedes();
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

                var objDatosHuespedes = getHuespedes();
                var form_data = "slEdificio="+$("#slEdificio").val()+"&slHabitacion="+$("#slHabitacion").val()+"&slCliente="+$("#slCliente").val()+"&txtControltxtFechaLlegada="+$("#txtControltxtFechaLlegada").val()+"&txtControltxtFechaSalida="+$("#txtControltxtFechaSalida").val()+"&txtMonto="+$("#txtMonto").val();
                var request   = $.ajax({
                    //url:          'http://' + usourl + '/php/reservaciones.func.php?job='+accion_cat+'&'+form_data+'&id='+sessionStorage.getItem("idcliente")+'&id_usuario='+sessionStorage.getItem("idusuario"),
                    url:          'http://' + usourl + '/php/reservaciones.func.php?job='+accion_cat+'&'+form_data,
                    cache:        false,
                    dataType:     'json',
                    data:         objDatosHuespedes,
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
            dataslHabitacion += "<option value='" + output.data[i].id_habitacion + "' data-preciohabitacion='" + output.data[i].precio + "' data-capacidadninos='" + output.data[i].capacidad_ninos + "' data-capacidadadultos='" + output.data[i].capacidad_adultos + "'>" + output.data[i].numero_habitacion + "</option>";
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

function getHuespedes(){
  huespedes   = [];

  $('.filashuesped').each(function(){
    let id_fila = this.id;
    let arrayIdFila = id_fila.split('-');
    let id = arrayIdFila[1];

    var nombre   = $("#nombre_huesped-"+id).attr("data-nombrehuesped");
    var edad     = $("#edad_huesped-"+id).attr("data-edadhuesped");

    huespedes.push({ nombre: nombre, edad: edad });
  });

  var objDatos = new Object();
  objDatos.huespedes = huespedes;

  return JSON.stringify( objDatos );
}

function contarHuespedes(){
  huespedes   = [];
  let huespedes_ninos = 0;
  let huespedes_adultos = 0;

  $('.filashuesped').each(function(){
    let id_fila = this.id;
    let arrayIdFila = id_fila.split('-');
    let id = arrayIdFila[1];

    let edad = $("#edad_huesped-"+id).attr("data-edadhuesped");

    if(edad > 1 && edad <12){
        huespedes_ninos=huespedes_ninos+1;
    }else if(edad > 12){
        huespedes_adultos=huespedes_adultos+1;
    }
  });

  var objDatos = new Object();
  objDatos.huespedes_ninos = huespedes_ninos;
  objDatos.huespedes_adultos = huespedes_adultos;

  return JSON.stringify( objDatos );
}