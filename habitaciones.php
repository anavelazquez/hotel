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
                    <h1>Listado de habitaciones</h1>

                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Administración</a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Habitaciones</li>
                        </ol>
                    </nav>
                    <button type="button" id="btnAgregar" name="btnAgregar" class="btn btn-primary mb-1">Agregar</button>
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
                                    <th>Id Habitación</th>
                                    <th>Edificio</th>
                                    <th>Nivel</th>
                                    <th>Tipo Habitación</th>
                                    <th>No. Habitación</th>
                                    <th>Vista</th>
                                    <th>Estatus</th>
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


        <div class="modal fade bd-example-modal-lg" id="modalActualiza" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lblDescModal">Actualizar habitación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-habitaciones">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="slEdificio">Edificio</label>
                                    <select id="slEdificio" name="slEdificio" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="txtNivel" class="col-form-label no-pt">Nivel:</label>
                                    <input type="text" class="form-control" id="txtNivel" name="txtNivel" maxlength="20" required>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="txtNoHabitacion" class="col-form-label no-pt">No. Habitación:</label>
                                    <input type="text" class="form-control" id="txtNoHabitacion" name="txtNoHabitacion" maxlength="180" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slTipoHabitacion">Tipo Habitación</label>
                                    <select id="slTipoHabitacion" name="slTipoHabitacion" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="slVista">Vista</label>
                                    <select id="slVista" name="slVista" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slEstatusHabitacion">Estatus</label>
                                    <select id="slEstatusHabitacion" name="slEstatusHabitacion" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
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
<script type="text/javascript" src="js/app/habitaciones.js?v=<?php echo time();?>"></script>
