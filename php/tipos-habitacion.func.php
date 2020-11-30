<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_tipos_habitacion'  || $job == 'add_tipo_habitacion' || $job == 'update_tipo_habitacion' || $job == 'delete_tipo_habitacion') {
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
  if ($job == 'get_tipos_habitacion'){
    $query =  "SELECT id_tipo_habitacion, descripcion_tipo_habitacion, precio, capacidad_ninos, capacidad_adultos FROM tipos_habitacion";

    $resultado = mysqli_query($con, $query);
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Editar Tipo Habitación '.$row['id_tipo_habitacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a> <a title="Eliminar Tipo Habitación '.$row['id_tipo_habitacion'].'" data-idtipohabitacion="'.$row['id_tipo_habitacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';
            $mysql_data[] = array(
            "id_tipo_habitacion" => $row['id_tipo_habitacion'],
            "descripcion_tipo_habitacion"     => $row['descripcion_tipo_habitacion'],
            "precio"     => $row['precio'],
            "capacidad_ninos"     => $row['capacidad_ninos'],
            "capacidad_adultos"     => $row['capacidad_adultos'],
            "functions"  => $functions
            );
        }
    }
  }  else if ($job == 'add_edificio') {


  } else if ($job == 'update_edificio') {

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