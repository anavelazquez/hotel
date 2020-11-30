<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Sistema de gestión hotelera</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="font/iconsmind/style.css" />
    <link rel="stylesheet" href="font/simple-line-icons/css/simple-line-icons.css" />

    <link rel="stylesheet" href="css/vendor/bootstrap.min.css" />
    <link rel="stylesheet" href="css/vendor/bootstrap-float-label.min.css" />
    <link rel="stylesheet" href="css/main.css" />
    <link rel="stylesheet" href="css/vendor/sweetalert.css">
</head>

<body class="background show-spinner">
    <div id="fondo" class="fixed-background"></div>
    <main id="contenedor">
        <div class="container">
            <div class="row h-100">
                <div class="col-12 col-md-10 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="position-relative image-side ">
                            <!--<p class=" text-black h2">NAILS BAR</p>-->
                            <!--<p class="black mb-0">Acceso al sistema Nails Bar</p>-->
                        </div>
                        <div class="form-side">
                            <a href="index.php">
                                <span class="logo-single"></span>
                            </a>
                            <h6 class="mb-4">Acceso al sistema</h6>

                            <form id="login-form">
                                <label class="form-group has-float-label mb-4">
                                    <input id="txtUsuario" name="txtUsuario" class="form-control" maxlength="40" required />
                                    <span>Usuario</span>
                                </label>

                                <label class="form-group has-float-label mb-4">
                                    <input id="txtContrasena" name="txtContrasena" class="form-control" maxlength="40" type="password" placeholder="" required />
                                    <span>Contraseña</span>
                                </label>
                                <div class="d-flex justify-content-between align-items-center">
                                    <button id="btnIngresar" name="btnIngresar" class="btn btn-primary btn-lg btn-shadow" type="button">Ingresar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <div id="div_carga" class="container" style="display:none;">
        <div id="preloader">
            <div id="loader"></div>
        </div>
    </div>
    <script src="js/vendor/jquery-3.3.1.min.js?v=<?php echo time();?>"></script>
    <script src="js/vendor/bootstrap.bundle.min.js?v=<?php echo time();?>"></script>
    <script src="js/dore.script.js?v=<?php echo time();?>"></script>
    <script src="js/scripts.js?v=<?php echo time();?>"></script>
    <script src="js/vendor/jquery.validate.min.js?v=<?php echo time();?>"></script>
    <script src="js/vendor/sweetalert.min.js?v=<?php echo time();?>"></script>
    <script type="text/javascript" src="js/urlbase.js?v=<?php echo time();?>"></script>
    <script src="js/app/login.js?v=<?php echo time();?>"></script>
</body>

</html>