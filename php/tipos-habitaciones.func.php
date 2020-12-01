<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_tipos_habitaciones'  || $job == 'add_tipo_habitacion' || $job == 'update_tipo_habitacion' || $job == 'delete_tipo_habitacion') {
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
  if ($job == 'get_tipos_habitaciones'){
    //descripcion_tipo_habitacion
    $query =  " SELECT id_tipo_habitacion, descripcion_tipo_habitacion, precio, capacidad_ninos, capacidad_adultos
                FROM tipos_habitacion";

    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Editar Tipo Habitación" data-idtipohabitacion="'.$row['id_tipo_habitacion'].'" data-descripciontipohabitacion="'.$row['descripcion_tipo_habitacion'].'" data-precio="'.$row['precio'].'" data-capacidadninos="'.$row['capacidad_ninos'].'" data-capacidadadultos="'.$row['capacidad_adultos'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a>   <a title="Eliminar Tipo Habitación" data-idtipohabitacion="'.$row['id_tipo_habitacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';

            $mysql_data[] = array(
              "id_tipo_habitacion" => $row['id_tipo_habitacion'],
              "descripcion_tipo_habitacion"  => $row['descripcion_tipo_habitacion'],
              "precio"  => $row['precio'],
              "capacidad_ninos"     => $row['capacidad_ninos'],
              "capacidad_adultos"     => $row['capacidad_adultos'],
              "functions"  => $functions
            );

        }
    }
  }  else if ($job == 'add_tipo_habitacion') {
    $txtDescripcion = $_GET['txtDescripcion'];
    $txtPrecio = $_GET['txtPrecio'];
    $txtCapacidadNinos = $_GET['txtCapacidadNinos'];
    $txtCapacidadAdultos = $_GET['txtCapacidadAdultos'];
    
    $query = "INSERT INTO tipos_habitacion (descripcion_tipo_habitacion, precio, capacidad_ninos, capacidad_adultos)";
    $query .= " VALUES ";
    $query .= "('".$txtDescripcion."',".$txtPrecio.", ".$txtCapacidadNinos.", ".$txtCapacidadAdultos.")";
    $resultado = mysqli_query($con, $query);
    $idultimo = mysqli_insert_id($con);

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        $mysql_data[] = array(
            "id_tipo_habitacion" => $idultimo
        );
    }
  } else if ($job == 'update_tipo_habitacion') {
    $txtDescripcion = $_GET['txtDescripcion'];
    $txtPrecio = $_GET['txtPrecio'];
    $txtCapacidadNinos = $_GET['txtCapacidadNinos'];
    $txtCapacidadAdultos = $_GET['txtCapacidadAdultos'];

    $query = "UPDATE tipos_habitacion ";
    $query .= "SET descripcion_tipo_habitacion = '".$txtDescripcion."', precio = ".$txtPrecio.", capacidad_ninos = ".$txtCapacidadNinos.", capacidad_adultos = ".$txtCapacidadAdultos;
    $query .= " WHERE id_tipo_habitacion = ".$id;
    $resultado = mysqli_query($con, $query);

    if (!$resultado){
      $error = mysqli_errno($con);
      $result  = 'error';
      $message = 'query error '.$error;
    }else{
        $result  = 'success';
        $message = 'query success';
    }
  }  else if ($job == 'delete_tipo_habitacion') {
    $query = "DELETE FROM tipos_habitacion ";
    $query .= "WHERE id_tipo_habitacion = ".$id;
    $resultado = mysqli_query($con, $query);

    if (!$resultado){
        $error = mysqli_errno($con);
        $result  = 'error';
        $message = 'query error '.$error;
    }else {
        $result  = 'success';
        $message = 'query success';
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