<?php include 'header.php';?>
<!-- Inicia Navbar -->
<?php include 'navbar.php';?>
<!-- Termina Navbar -->
<!-- Inicia Sidebar -->
<?php include 'sidebar.php';?>
<!-- Termina Sidebar -->
<!-- Inicia Contenido -->
<main>
    <div class="container-fluid disable-text-selection">
        <div class="row">
            <div class="col-12">
                <div class="mb-2">
                    <h1>Reservaciones</h1>

                    <button type="button" id="btnAgregar" name="btnAgregar" class="btn btn-primary mb-1">Agregar Reservación</button>
                </div>

                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 mb-12">
                <div class="card h-100">
                    <div class="card-body">
                        <table id="data-table-simple" class="responsive-table display" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Id Reservación</th>
                                    <th>Cliente</th>
                                    <th>No. Hab.</th>
                                    <th>Tipo Hab.</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Monto</th>
                                    <th>Fecha reservación</th>
                                    <th>Estatus</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalActualiza" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lblDescModal">Actualizar Reservación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-reservacion">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="slEdificio">Edificio</label>
                                    <select id="slEdificio" name="slEdificio" class="form-control" >
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slHabitacion">Habitación</label>
                                    <select id="slHabitacion" name="slHabitacion" class="form-control" >
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12" id="reloadSlCliente">
                                    <label for="slCliente">Cliente</label>
                                    <select id="slCliente" name="slCliente" class="form-control">
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="txtControltxtFechaNacimiento" class="col-form-label">Fecha Llegada:</label>
                                    <div class="form-group col-md-12" style="padding-left:0px; padding-right:0px;">
                                        <div class="input-group date" id="txtFechaLlegada" data-target-input="nearest" style="margin-bottom:1rem;">
                                            <input type="text" id="txtControltxtFechaLlegada" class="form-control datetimepicker-input valid" data-target="#txtFechaLlegada" aria-invalid="false" style="background-color: rgb(255, 255, 204);">
                                            <div id="contentCalendarF" class="input-group-append" data-target="#txtFechaLlegada" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="simple-icon-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtControltxtFechaNacimiento" class="col-form-label">Fecha Salida:</label>
                                    <div class="form-group col-md-12" style="padding-left:0px; padding-right:0px;">
                                        <div class="input-group date" id="txtFechaSalida" data-target-input="nearest" style="margin-bottom:1rem;">
                                            <input type="text" id="txtControltxtFechaSalida" class="form-control datetimepicker-input valid" data-target="#txtFechaSalida" aria-invalid="false" style="background-color: rgb(255, 255, 204);">
                                            <div id="contentCalendarF" class="input-group-append" data-target="#txtFechaSalida" data-toggle="datetimepicker">
                                                <div class="input-group-text"><i class="simple-icon-calendar"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="txtMonto" class="col-form-label">Monto:</label>
                                    <input type="text" class="form-control" id="txtMonto" name="txtMonto" maxlength="12" >
                                </div>
                            </div>
                            <!--<div class="form-row">
                                <label>Huespedes</label>
                            </div>-->
                            <div>Ingrese los huéspedes</div>
                            <div class="form-row">
                                <div class="form-group col-md-8">
                                    <input type="text" class="form-control" id="txtNombreHuesped" name="txtNombreHuesped" placeholder="Nombre huesped">
                                </div>
                                <div class="form-group col-md-4">
                                    <input type="text" class="form-control" id="txtEdadHuesped" name="txtEdadHuesped" placeholder="Edad">
                                </div>
                            </div>
                            <div class="form-row">
                                <table style="width:100%;" id="tblHuespedesReservacion">
                                    <tr>
                                        <th>Nombre huésped</th>
                                        <th>Edad</th>
                                        <th class="text-center">Acción</th>
                                    </tr>
                                    <tbody id="itemlist">
                                    </tbody>
                                </table>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary">Guardar</button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
<!-- Termina Contenido -->
<?php include 'footer.php';?>
<script type="text/javascript" src="js/app/reservaciones.js?v=<?php echo time();?>"></script>
