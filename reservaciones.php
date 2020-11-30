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
                                    <th>Edificio</th>
                                    <th>Habitación</th>
                                    <th>Llegada/Salida</th>
                                    <th>Cliente</th>
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
                        <form id="form-clientes">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="slEdificio">Edificio</label>
                                    <select id="slEdificio" name="slEdificio" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="slHabitacion">Habitación</label>
                                    <select id="slHabitacion" name="slHabitacion" class="form-control" required>
                                        <option disabled selected="">Seleccione</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row">

                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-4" id="reloadSlCliente">
                                    <select id="slCliente" name="slCliente" class="form-control">
                                    </select>
                                </div>
                                <div class="form-group col-md-1">
                                    <button type="button" id="btnModalAgregaCliente" class="btn btn-primary default mb-1" data-toggle="tooltip" data-placement="top" title="" data-original-title="Agregar cliente"><i class="glyph-icon simple-icon-user-follow"></i></button>
                                </div>
                            </div>




                            <div class="form-group">
                                <label for="txtNombre" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="txtNombre" name="txtNombre" maxlength="180" required>
                            </div>
                            <div class="form-group">
                                <label for="txtPrimerApellido" class="col-form-label">Primer Apellido:</label>
                                <input type="text" class="form-control" id="txtPrimerApellido" name="txtPrimerApellido" maxlength="180" required>
                            </div>
                            <div class="form-group">
                                <label for="txtSegundoApellido" class="col-form-label">Segundo Apellido:</label>
                                <input type="text" class="form-control" id="txtSegundoApellido" name="txtSegundoApellido" maxlength="180" required>
                            </div>
                            <div class="form-group">
                                <label for="txtUsername" class="col-form-label">Nombre de usuario:</label>
                                <input type="text" class="form-control" id="txtUsername" name="txtUsername" maxlength="180" required>
                            </div>
                            <div class="form-group">
                                <label for="txtPassword" class="col-form-label">Contraseña:</label>
                                <input type="text" class="form-control" id="txtPassword" name="txtPassword" maxlength="180" required>
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
<script type="text/javascript" src="js/app/clientes.js?v=<?php echo time();?>"></script>
