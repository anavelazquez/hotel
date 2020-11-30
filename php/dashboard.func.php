<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_tablero_empleados') {
      if (isset($_GET['id'])){
          $id = $_GET['id'];
          if (!is_numeric($id)){
            $id = '';
          }
      }
    } else {
      $job = '';
    }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != ''){
  // Connect to database
  $con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
    $job     = '';
  }

  mysqli_set_charset($con,"utf8");

  // Execute job
  if ($job == 'get_tablero_empleados'){     
    $query =  " SELECT nombre_completo empleada, domingo, lunes, martes, miercoles, jueves, viernes, sabado 
    FROM horarios_concentrados";     
    $resultado = mysqli_query($con, $query);        
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';         
        while ($row = mysqli_fetch_array($resultado)) {                                               
            $mysql_data[] = array(                           
            "empleada"  => $row['empleada'],
            "domingo"   => $row['domingo'],
            "lunes"     => $row['lunes'],
            "martes"    => $row['martes'],
            "miercoles" => $row['miercoles'],
            "jueves"    => $row['jueves'],                    
            "viernes"   => $row['viernes'],                    
            "sabado"    => $row['sabado']                                
            );
        }
    }    
  }   
} 

// Prepare data
$data = array(
  "result"  => $result,
  "message" => $message,
  "data"    => $mysql_data
);

// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;

?>