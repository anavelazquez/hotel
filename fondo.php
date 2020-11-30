<?php include 'header.php';?>
<!-- Inicia Navbar -->
<?php include 'navbar.php';?>
<!-- Termina Navbar -->
<!-- Inicia Sidebar -->
<?php include 'sidebar.php';?>        
<!-- Termina Sidebar -->
<!-- Inicia Contenido -->
<main>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h1>Actualización Fondo</h1>
                <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                    <ol class="breadcrumb pt-0">
                        <li class="breadcrumb-item">
                            <a href="#">Adminstración</a>
                        </li>                        
                        <li class="breadcrumb-item active" aria-current="page">Fondo</li>
                    </ol>
                </nav>
                <div class="separator mb-5"></div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">                
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="mb-4">Actualización Fondo</h5>

                        <form id="form-fondo">                            
                            <div class="form-group">
                                <label for="inputAddress">Fondo Actual</label>
                                <input type="text" class="form-control" id="txtFondoActual" name="txtFondoActual"  placeholder="" readonly>
                            </div>
                            <div class="form-group">
                                <label for="inputAddress2">Monto Nuevo</label>
                                <input type="text" class="form-control" id="txtMontoNuevo" name="txtMontoNuevo" placeholder="">
                            </div>
                                                        
                            <button type="button" id="btnGuardar" name="btnGuardar" class="btn btn-primary d-block mt-3">Guardar</button>
                        </form>
                    </div>
                </div>
            
            </div>
        </div>
    </div>
</main>
<!-- Termina Contenido -->
<?php include 'footer.php';?>    
<script type="text/javascript" src="js/app/fondo.js?v=<?php echo time();?>"></script>