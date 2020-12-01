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
                    <h1>Check IN y Check OUT</h1>

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Administración</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Check IN / Check OUT</li>
                        </ol>
                    </nav>
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
                                    <th>Edificio</th>
                                    <th>No.Habitación</th>
                                    <th>Nombre Huésped</th>
                                    <th>Edad Huésped</th>
                                    <th>Fecha Reservación</th>
                                    <th>Fecha Inicio</th>
                                    <th>Fecha Fin</th>
                                    <th>Check IN</th>
                                    <th>Check OUT</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade bd-example-modal-lg" id="modalCheck" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lblDescModal">Registrar Check IN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-checkin-checkout">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtEdificio" class="col-form-label no-pt">Edicifio:</label>
                                    <input type="text" class="form-control" id="txtEdificio" name="txtEdificio" maxlength="20" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtNoHabitacion" class="col-form-label no-pt">No. Habitación:</label>
                                    <input type="text" class="form-control" id="txtNoHabitacion" name="txtNoHabitacion" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtNombreHuesped" class="col-form-label no-pt">Nombre Huésped:</label>
                                    <input type="text" class="form-control" id="txtNombreHuesped" name="txtNombreHuesped" maxlength="20" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtEdad" class="col-form-label no-pt">Edad:</label>
                                    <input type="text" class="form-control" id="txtEdad" name="txtEdad" maxlength="20" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                <label for="txtFechaHoraCheckInOut" id="lblFechaHora">Fecha/Hora Check IN</label>
                                <div class="input-group date" id="txtFechaHoraCheckInOut" data-target-input="nearest">                                
                                    <input type="text" id="txtControlFechaHoraCheckInOut" class="form-control datetimepicker-input" data-target="#txtFechaHoraCheckInOut"/>
                                    <div class="input-group-append" data-target="#txtFechaHoraCheckInOut" data-toggle="datetimepicker">
                                        <div class="input-group-text"><i class="simple-icon-calendar"></i></div>
                                    </div>
                                </div>                            
                            </div> 
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
<script type="text/javascript" src="js/app/checkin-checkout.js?v=<?php echo time();?>"></script>
