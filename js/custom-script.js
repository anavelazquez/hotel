var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate();

var fechaactual = d.getFullYear() + '-' + ((''+month).length<2 ? '0' : '') + month + '-' + ((''+day).length<2 ? '0' : '') + day;

$( document ).ready(function() {
	$.validator.addMethod("decimal4", function(value, element, param) {
		//return this.optional(element) || /^([a-zA-Z0-9 ]*)/.test(value);
		return this.optional(element) || /^(\d{1,2}\.\d{1,2}|\d{1,2})$/.test(value);
	}, "Ingrese una comisión válida");

	$.validator.addMethod("importe2dec", function(value, element, param) {
		//return this.optional(element) || /^([a-zA-Z0-9 ]*)/.test(value);
		return this.optional(element) || /^[0-9]+(\.[0-9]{1,2})?$/.test(value);
	}, "Ingrese un importe válido");	

	$.validator.addMethod("time24", function(value, element) { 
		if (!/^\d{2}:\d{2}:\d{2}$/.test(value)) return false;
		var parts = value.split(':');
		if (parts[0] > 23 || parts[1] > 59 || parts[2] > 59) return false;
		return true;
	}, "Formato de tiempo inválido.");

	if ( sessionStorage.getItem("usr") == undefined ) {
		window.location = "index.php";
	} else {
		//$("#lblNombreUsuario").text(sessionStorage.getItem("nombre"));
		//$("#lblDescUsuario").text(sessionStorage.getItem("descripcion"));

		$("#lblDescUsuario").text(sessionStorage.getItem("usr"));
		
		if (sessionStorage.getItem("es_admin") == "S") {
			$(".Admin").show();			
		} else if (sessionStorage.getItem("esadmin") == "N") {						
			$(".Admin").hide();		
		}
	}

	$( "#btnCerrarSesion" ).click(function(e) {
		e.preventDefault();   
		sessionStorage.clear();
		window.location.href = "index.php";
	});	

	$(".switch").find("input[type=checkbox]").on("change",function() {        
        var id = this.id;
        if (id == "swActivo") {
            if($("#"+id).is(":checked")) {
                $("#"+id).val('S');
            } else {
                $("#"+id).val('N');
            }
        }
    });

});

function getFechaActual() {
	var today = new Date();
	var dd = today.getUTCDate();
	var mm = today.getUTCMonth()+1;
	var yyyy = today.getUTCFullYear();
	if(dd<10) { dd='0'+dd; }
	if(mm<10) { mm='0'+mm; }
	today = yyyy+'-'+mm+'-'+dd;

	return today;
}

function detalleVentas(idVenta,tipodetalle){
	var cadenavalores = "";
	var cadenavaloresnueser = "";
	var cadenavaloresforpag = "";
  
	$.each( $( ".filaservicio" ), function() {		
		var consecutivo    = $("#" + $(this).find(" td:eq(0) ").attr("id")).text(); 
		var idservicio     = $("#" + $(this).find(" td:eq(1)").attr("id")).data("idserv");
		var fechorcitaini  = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("servhini");    
		var fechorcitafin  = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("servhfin"); 
		var idempatie      = $("#" + $(this).find(" td:eq(1)").attr("id")).data("idemp");
		var tiposervpro    = $("#" + $(this).find(" td:eq(1)").attr("id")).data("tiposervpro");
		var preciounitario = $("#" + $(this).find(" td:eq(5) input").attr("id")).val().replace("$ ","");
		var unidad         = $("#" + $(this).find(" td:eq(6) input").attr("id")).val();        
		var descuento      = $("#" + $(this).find(" td:eq(8) input[type='text']").attr("id")).val().replace(" %","");
		var impdescuento   = $("#" + $(this).find(" td:eq(9) input[type='text']").attr("id")).val().replace("$ ","");
		var total          = $("#" + $(this).find(" td:eq(10) input").attr("id")).val().replace("$ ","");   
  		if (descuento == "undefined" || descuento == "") { descuento = "0.00"; }
		
		cadenavalores += consecutivo + ";" + idservicio + ";" + idempatie + ";" + tiposervpro + ";" + unidad + ";" + descuento + ";" + impdescuento + ";" + preciounitario + ";" + total + ";" + "|";

		/*
		var consecutivo   = $("#"+ $(this).find(" td:eq(0) ").attr("id")).text();
		var idservicio    = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("idserv");    
		var idempleado    = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("idemp");    
		var fechorcitaini = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("servhini");    
		var fechorcitafin = $("#"+ $(this).find(" td:eq(1) ").attr("id")).data("servhfin"); 
		*/

		cadenavaloresnueser += consecutivo + ";" + idservicio + ";" + idempatie + ";" + fechorcitaini + ";" + fechorcitafin + ";" + "|";
	});

	if (tipodetalle == "cierre") {
		$.each( $( ".filaformapago" ), function() {		
			var idforpag   = $("#" + $(this).find(" td:eq(1)").attr("id")).data("idforpag");
			var importepag = $("#" + $(this).find(" td:eq(2) input").attr("id")).val().replace("$ ","");
			var importesal = 0;
			//cuando el importe genere cabio
			//solo tomar la parte restante de la cuenta para los reportes
			//if (parseFloat(importepag) > parseFloat($("#lblTotalFinalAPagar").text().replace("$ ",""))) {
			//	importesal = $("#lblTotalFinalAPagar").text().replace("$ ","");	
			//} else {
				importesal = $("#" + $(this).find(" td:eq(2) input").attr("id")).data("salpag");
			//}
			
			cadenavaloresforpag += idforpag + ";" + importepag + ";" + importesal + ";" + "|";
		});	
	}

	var urlusodet = "";
	if (tipodetalle == "cierre") {
		urlusodet = 'http://' + usourl + '/php/ventas.func.php?job=add_detalle_ventas&valoresventa='+cadenavalores+'&idv='+idVenta+'&tipodetalle='+tipodetalle+'&id_cita='+sessionStorage.getItem("idcita")+'&cadenavaloresforpag='+cadenavaloresforpag+'&ser_nue='+sessionStorage.getItem("ser_nue")+'&cadenavaloresnueser='+cadenavaloresnueser;
	} else {
		urlusodet = 'http://' + usourl + '/php/ventas.func.php?job=add_detalle_ventas&valoresventa='+cadenavalores+'&idv='+idVenta+'&tipodetalle='+tipodetalle+'&id_cita='+sessionStorage.getItem("idcita")+'&ser_nue=N';
	}
	  
	var request   = $.ajax({
		url:          urlusodet,
		cache:        false,
		//data:         form_data,
		dataType:     'json',
		contentType:  'application/json; charset=utf-8',
		type:         'get'
	});
	request.done(function(output){       
		if (output.result == 'success'){         
			//debugger;
			//alert('Venta realizada con éxito');        
			//alert(sessionStorage.getItem('idusr'));
			//idcliente dependiendo
			//window.location.href = "ventas.php";         
		} else {
			alert('Add request failed');          
		}            
	  //window.location.href = "ventas.php";
	});
		request.fail(function(jqXHR, textStatus){
		alert('Add request failed: ' + textStatus);       
	});    
  }

/*
$.datepicker.regional['es'] = {
	closeText: 'Cerrar',
	prevText: '< Ant',
	nextText: 'Sig >',
	currentText: 'Hoy',
	monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
	monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
	dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	weekHeader: 'Sm',
	dateFormat: 'dd/mm/yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
	};
	$.datepicker.setDefaults($.datepicker.regional['es']);
   */

function VentanaCentrada(theURL,winName,features, myWidth, myHeight, isCenter) { //v3.0
	if(window.screen)if(isCenter)if(isCenter=="true"){
	  var myLeft = (screen.width-myWidth)/2;
	  var myTop = (screen.height-myHeight)/2;
	  features+=(features!='')?',':'';
	  features+=',left='+myLeft+',top='+myTop;
	}
	window.open(theURL,winName,features+((features!='')?',':'')+'width='+myWidth+',height='+myHeight);
}