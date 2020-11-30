<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_vistas'  || $job == 'add_vista' || $job == 'update_vista' || $job == 'delete_vista') {
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
  if ($job == 'get_vistas'){
    $query =  "SELECT id_vista, descripcion_vista FROM vistas";

    $resultado = mysqli_query($con, $query);
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Editar Vista '.$row['id_vista'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a> <a title="Eliminar Vista '.$row['id_vista'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';
            $mysql_data[] = array(
            "id_vista" => $row['id_vista'],
            "descripcion_vista"     => $row['descripcion_vista'],
            "functions"  => $functions
            );
        }
    }
  }  else if ($job == 'add_vista') {


  } else if ($job == 'update_vista') {

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