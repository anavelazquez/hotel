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
                    <h1>Listado de edificios</h1>
                    
                    <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                        <ol class="breadcrumb pt-0">
                            <li class="breadcrumb-item">
                                <a href="#">Administración</a>
                            </li>                            
                            <li class="breadcrumb-item active" aria-current="page">Edificios</li>
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
                                    <th>Id Edificio</th>
                                    <th>Descripcion Edificio</th>
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

        <div class="modal fade" id="modalActualiza" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="lblDescModal">Actualizar edificio</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="form-edificios">
                            <div class="form-group">
                                <label for="txtNombreEdificio" class="col-form-label">Nombre Edificio:</label>
                                <input type="text" class="form-control" id="txtNombreEdificio" name="txtNombreEdificio" maxlength="180" required>
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
<script type="text/javascript" src="js/app/edificios.js?v=<?php echo time();?>"></script>
