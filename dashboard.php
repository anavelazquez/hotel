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
        <div class="row" style="display:none;">
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        <div class="date">
                            <span id="weekDay" class="weekDay"></span>, 
                            <span id="day" class="day"></span> de
                            <span id="month" class="month"></span> del
                            <span id="year" class="year"></span>
                        </div>
                        <div class="clock">
                            <span id="hours" class="hours"></span> :
                            <span id="minutes" class="minutes"></span> :
                            <span id="seconds" class="seconds"></span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-lg-6 mb-4">
                <div class="card h-100">
                    <div class="card-body">
                        
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12 col-lg-12 mb-4">
                <div class="card h-100">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<!-- Termina Contenido -->
<?php include 'footer.php';?>
<script type="text/javascript" src="js/app/dashboard.js?v=<?php echo time();?>"></script>
<script src="js/vendor/clock.js"></script>
