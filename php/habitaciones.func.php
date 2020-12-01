<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_habitaciones'  || $job == 'add_habitacion' || $job == 'update_habitacion' || $job == 'delete_habitacion') {
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
  if ($job == 'get_habitaciones'){
    //descripcion_tipo_habitacion
    $query =  " SELECT id_habitacion, habitaciones.id_edificio as id_edificio, nombre_edificio, nivel_piso, numero_habitacion, habitaciones.id_tipo_habitacion, descripcion_tipo_habitacion, habitaciones.id_vista, descripcion_vista, habitaciones.id_estatus_habitacion, descripcion_estatus_habitacion, tipos_habitacion.precio
                FROM habitaciones
                INNER JOIN edificios ON habitaciones.id_edificio = edificios.id_edificio
                INNER JOIN vistas ON habitaciones.id_vista = vistas.id_vista
                INNER JOIN tipos_habitacion ON habitaciones.id_tipo_habitacion = tipos_habitacion.id_tipo_habitacion
                INNER JOIN estatus_habitacion ON habitaciones.id_estatus_habitacion = estatus_habitacion.id_estatus_habitacion";

    $resultado = mysqli_query($con, $query) or die ('Unable to execute query. '. mysqli_error($con));

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Editar habitación" data-idhabitacion="'.$row['id_habitacion'].'" data-idedificio="'.$row['id_edificio'].'" data-nivelpiso="'.$row['nivel_piso'].'" data-numerohabitacion="'.$row['numero_habitacion'].'" data-idtipohabitacion="'.$row['id_tipo_habitacion'].'" data-idvista="'.$row['id_vista'].'" data-idestatushabitacion="'.$row['id_estatus_habitacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a>   <a title="Eliminar habitación" data-idhabitacion="'.$row['id_habitacion'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';

            $mysql_data[] = array(
              "id_habitacion" => $row['id_habitacion'],
              "id_edificio"  => $row['id_edificio'],
              "nombre_edificio"  => $row['nombre_edificio'],
              "nivel_piso"     => $row['nivel_piso'],
              "numero_habitacion"     => $row['numero_habitacion'],
              "descripcion_tipo_habitacion"     => $row['descripcion_tipo_habitacion'],
              "descripcion_vista"     => $row['descripcion_vista'],
              "descripcion_estatus_habitacion"     => $row['descripcion_estatus_habitacion'],
              "precio"     => $row['precio'],
              "functions"  => $functions
            );

        }
    }
  }  else if ($job == 'add_habitacion') {
    $slEdificio = $_GET['slEdificio'];
    $txtNivel = $_GET['txtNivel'];
    $txtNoHabitacion = $_GET['txtNoHabitacion'];
    $slTipoHabitacion = $_GET['slTipoHabitacion'];
    $slVista = $_GET['slVista'];
    $slEstatusHabitacion = $_GET['slEstatusHabitacion'];

    //Se agrega usuario
    $query = "INSERT INTO habitaciones (id_edificio, nivel_piso, numero_habitacion, id_tipo_habitacion, id_vista, id_estatus_habitacion)";
    $query .= " VALUES ";
    $query .= "(".$slEdificio.",'".$txtNivel."', '".$txtNoHabitacion."', ".$slTipoHabitacion.", ".$slVista.", ".$slEstatusHabitacion.")";
    $resultado = mysqli_query($con, $query);
    $idultimo = mysqli_insert_id($con);

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        $mysql_data[] = array(
            "id_habitacion" => $idultimo
        );
    }
  } else if ($job == 'update_habitacion') {
    $slEdificio = $_GET['slEdificio'];
    $txtNivel = $_GET['txtNivel'];
    $txtNoHabitacion = $_GET['txtNoHabitacion'];
    $slTipoHabitacion = $_GET['slTipoHabitacion'];
    $slVista = $_GET['slVista'];
    $slEstatusHabitacion = $_GET['slEstatusHabitacion'];

    $query = "UPDATE habitaciones ";
    $query .= "SET id_edificio = ".$slEdificio.", nivel_piso = '".$txtNivel."', numero_habitacion = '".$txtNoHabitacion."', id_tipo_habitacion = ".$slTipoHabitacion.", id_vista = ".$slVista.", id_estatus_habitacion = ".$slEstatusHabitacion;
    $query .= " WHERE id_habitacion = ".$id;
    $resultado = mysqli_query($con, $query);

    if (!$resultado){
      $error = mysqli_errno($con);
      $result  = 'error';
      $message = 'query error '.$error;
    }else{
        $result  = 'success';
        $message = 'query success';
    }
  }  else if ($job == 'delete_habitacion') {
    $query = "DELETE FROM habitaciones ";
    $query .= "WHERE id_habitacion = ".$id;
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