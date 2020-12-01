<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_reservaciones' || $job == 'add_reservacion') {
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
  if ($job == 'get_reservaciones') {
    $query =  " SELECT id_reservacion, CONCAT(c.nombre, ' ', c.primer_apellido, ' ', c.segundo_apellido) nombre_completo, 
      h.numero_habitacion nohab, th.descripcion_tipo_habitacion tipohab,
      r.fecha_inicio, r.fecha_fin, r.monto, r.fecha_reservacion, r.id_estatus_reservacion, er.descripcion_estatus_reservacion estatus_reserva
      FROM reservacion r
        INNER JOIN clientes c ON c.id_cliente = r.id_cliente
        INNER JOIN estatus_reservacion er ON er.id_estatus_reservacion = r.id_estatus_reservacion
        INNER JOIN habitaciones h ON h.id_habitacion = r.id_habitacion
        INNER JOIN tipos_habitacion th ON th.id_tipo_habitacion = h.id_tipo_habitacion";

    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
      $result  = 'error';
      $message = 'query error';
    } else {
      $result  = 'success';
      $message = 'query success';
      while ($row = mysqli_fetch_array($resultado)) {
        $functions = '<a title="Cancelar reservación" data-idreservacion="'.$row['id_reservacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';

        $mysql_data[] = array(
          "id_reservacion" => $row['id_reservacion'],
          "nombre_completo"  => $row['nombre_completo'],
          "nohab"  => $row['nohab'],
          "tipohab"  => $row['tipohab'],
          "fecha_inicio"  => $row['fecha_inicio'],
          "fecha_fin"     => $row['fecha_fin'],
          "monto"     => $row['monto'],
          "fecha_reservacion"     => $row['fecha_reservacion'],
          "estatus_reserva"     => $row['estatus_reserva'],
          "functions"  => $functions
        );
      }
    }
  } else if ($job == 'add_reservacion') {
    $slEdificio = $_GET['slEdificio'];
    $slHabitacion  = $_GET['slHabitacion'];
    $slCliente  = $_GET['slCliente'];
    $txtControltxtFechaLlegada = $_GET['txtControltxtFechaLlegada'];
    $txtControltxtFechaSalida  = $_GET['txtControltxtFechaSalida'];
    $txtMonto = $_GET['txtMonto'];

    //Se agrega reservacion
    $query = "INSERT INTO reservacion (id_cliente, id_habitacion, fecha_inicio, fecha_fin, monto, fecha_reservacion, id_estatus_reservacion)";
    $query .= " VALUES ";
    $query .= "(".$slCliente.",".$slHabitacion.",'".$txtControltxtFechaLlegada."','".$txtControltxtFechaSalida."','".$txtMonto."',CURDATE(),1)";

    $resultado = mysqli_query($con, $query);
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        /*$mysql_data[] = array(
            "id_cliente" => $idultimo
        );*/
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