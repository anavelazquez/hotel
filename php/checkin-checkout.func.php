<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_reservaciones_detalle'  || $job == 'registrar_check_in' || $job == 'registrar_check_out') {
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
  if ($job == 'get_reservaciones_detalle'){
    $query =  "SELECT reservacion_huespedes.id_reservacion_huesped, nombre_edificio, numero_habitacion, nombre_huesped, edad_huesped, fecha_inicio, fecha_fin, fecha_reservacion, fecha_check_in, fecha_check_out
      FROM reservacion_huespedes
      INNER JOIN reservacion ON reservacion.id_reservacion = reservacion_huespedes.id_reservacion
      INNER JOIN reservacion_detalle ON reservacion_detalle.id_reservacion_huesped = reservacion_huespedes.id_reservacion_huesped
      INNER JOIN habitaciones ON reservacion.id_habitacion = habitaciones.id_habitacion
      INNER JOIN edificios ON habitaciones.id_edificio = edificios.id_edificio
      WHERE reservacion.id_estatus_reservacion = 1";

    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Registrar Check IN" data-idreservacionhuesped="'.$row['id_reservacion_huesped'].'" data-nombreedificio="'.$row['nombre_edificio'].'" data-numerohabitacion="'.$row['numero_habitacion'].'" data-nombrehuesped="'.$row['nombre_huesped'].'" data-edadhuesped="'.$row['edad_huesped'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_checkin" href="#">Check IN</a> <a title="Registrar Check OUT" data-idreservacionhuesped="'.$row['id_reservacion_huesped'].'" data-nombreedificio="'.$row['nombre_edificio'].'" data-numerohabitacion="'.$row['numero_habitacion'].'" data-nombrehuesped="'.$row['nombre_huesped'].'" data-edadhuesped="'.$row['edad_huesped'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_checkout" href="#">Check OUT</a>';

            $mysql_data[] = array(
              //"id_reservacion_huesped" => $row['id_reservacion_huesped'],
              "nombre_edificio"  => $row['nombre_edificio'],
              "numero_habitacion"  => $row['numero_habitacion'],
              "nombre_huesped"     => $row['nombre_huesped'],
              "edad_huesped"     => $row['edad_huesped'],
              "fecha_inicio"     => $row['fecha_inicio'],
              "fecha_fin"  => $row['fecha_fin'],
              "fecha_reservacion"     => $row['fecha_reservacion'],
              "fecha_check_in"  => $row['fecha_check_in'],
              "fecha_check_out"     => $row['fecha_check_out'],
              "functions"  => $functions
            );

        }
    }
  }  else if ($job == 'registrar_check_in') {
    $txtControlFechaHoraCheckInOut = $_GET['txtControlFechaHoraCheckInOut'];
    $date = new DateTime($txtControlFechaHoraCheckInOut);
    $fecha_check_in = $date->format('Y-m-d H:i:s');
    //print_r($txtControlFechaHoraCheckInOut);
    $query = "UPDATE reservacion_detalle ";
    $query .= "SET fecha_check_in = '".$fecha_check_in."'";
    $query .= " WHERE id_reservacion_detalle = ".$id;
    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        $mysql_data[] = array();
    }
  } else if ($job == 'registrar_check_out') {
    $txtControlFechaHoraCheckInOut = $_GET['txtControlFechaHoraCheckInOut'];
    $date = new DateTime($txtControlFechaHoraCheckInOut);
    $fecha_check_out = $date->format('Y-m-d H:i:s');
    //print_r($txtControlFechaHoraCheckInOut);
    $query = "UPDATE reservacion_detalle ";
    $query .= "SET fecha_check_out = '".$fecha_check_out."'";
    $query .= " WHERE id_reservacion_detalle = ".$id;
    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        $mysql_data[] = array();
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