<nav class="navbar fixed-top">
    <div class="d-flex align-items-center navbar-left">
        <a href="#" class="menu-button d-none d-md-block">
            <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                <rect x="0.48" y="0.5" width="7" height="1" />
                <rect x="0.48" y="7.5" width="7" height="1" />
                <rect x="0.48" y="15.5" width="7" height="1" />
            </svg>
            <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                <rect x="1.56" y="0.5" width="16" height="1" />
                <rect x="1.56" y="7.5" width="16" height="1" />
                <rect x="1.56" y="15.5" width="16" height="1" />
            </svg>
        </a>

        <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                <rect x="0.5" y="0.5" width="25" height="1" />
                <rect x="0.5" y="7.5" width="25" height="1" />
                <rect x="0.5" y="15.5" width="25" height="1" />
            </svg>
        </a>
        
    </div>

    <a class="navbar-logo" href="dashboard.php">
        <span class="logo d-none d-xs-block"></span>
        <span class="logo-mobile d-block d-xs-none"></span>
    </a>

    <div class="navbar-right">
        <?php
            //if( basename($_SERVER['PHP_SELF'], '.php') == 'agenda' || basename($_SERVER['PHP_SELF'], '.php') == 'ventas' ) {                        
            if( basename($_SERVER['PHP_SELF'], '.php') == 'ventas' ) {                        
        ?>
        <div class="header-icons d-inline-block align-middle">            
            <div class="position-relative d-inline-block">
                <button class="header-icon btn btn-empty" type="button" id="notificationButton" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i class="simple-icon-bell"></i>
                    <span id="contnotificacion" class="count">3</span>
                </button>
                <div class="dropdown-menu dropdown-menu-right mt-3 scroll position-absolute" id="notificationDropdown">                    
                </div>
            </div>
                        
        </div>

        <?php
            } 
        ?>

        <div class="user d-inline-block">
            <button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                <span id="lblDescUsuario" name="lblDescUsuario" class="name"></span>
                <span>
                    <img alt="Profile Picture" src="img/profile-pic-l-11.jpg" />
                </span>
            </button>

            <div class="dropdown-menu dropdown-menu-right mt-3">                
                <a id="btnCerrarSesion" class="dropdown-item" href="#">Cerrar sesión</a>
            </div>
        </div>
    </div>
</nav>