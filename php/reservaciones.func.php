<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_clientes'  || $job == 'add_cliente' || $job == 'update_cliente' || $job == 'delete_cliente') {
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
  if ($job == 'get_clientes'){
    $query =  " SELECT id_cliente, CONCAT(nombre, ' ', primer_apellido, ' ', segundo_apellido) nombre_completo, nombre, primer_apellido, segundo_apellido, nombre, fecha_registro, usuarios.id_usuario, username
                FROM clientes
                INNER JOIN usuarios
                ON clientes.id_usuario = usuarios.id_usuario";

    $resultado = mysqli_query($con, $query);

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';
        while ($row = mysqli_fetch_array($resultado)) {
            $functions = '<a title="Editar cliente '.$row['id_cliente'].'" data-idcliente="'.$row['id_cliente'].'" data-nombre="'.$row['nombre'].'" data-primer_apellido="'.$row['primer_apellido'].'" data-segundo_apellido="'.$row['segundo_apellido'].'" data-fecha_registro="'.$row['fecha_registro'].'" data-idusuario="'.$row['id_usuario'].'" data-username="'.$row['username'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a> <a title="Eliminar cliente '.$row['id_cliente'].'" data-idcliente="'.$row['id_cliente'].'" data-idusuario="'.$row['id_usuario'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';

            $mysql_data[] = array(
              "id_cliente" => $row['id_cliente'],
              "nombre_completo"     => $row['nombre_completo'],
              "fecha_registro"  => $row['fecha_registro'],
              "functions"  => $functions
            );
        }
    }
  }  else if ($job == 'add_cliente') {
    $txtNombre = $_GET['txtNombre'];
    $txtPrimerApellido = $_GET['txtPrimerApellido'];
    $txtSegundoApellido = $_GET['txtSegundoApellido'];
    $txtUsername = $_GET['txtUsername'];
    $txtPassword = $_GET['txtPassword'];

    //Se agrega usuario
    $query = "INSERT INTO usuarios (id_rol, username, password)";
    $query .= " VALUES ";
    $query .= "(3,'".$txtUsername."','".$txtPassword."')";
    $resultadoUsuario = mysqli_query($con, $query);

    //Se recupera id_usuario
    $idUsuario = mysqli_insert_id($con);

    //Se agrega cliente
    $query2 = "INSERT INTO clientes (id_usuario, nombre, primer_apellido, segundo_apellido, fecha_registro)";
    $query2 .= "VALUES ";
    $query2 .= "(".$idUsuario.",'".$txtNombre."','".$txtPrimerApellido."','".$txtSegundoApellido."', CURDATE()) ";
    $resultado = mysqli_query($con, $query2);
    $idultimo = mysqli_insert_id($con);


    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';

        $mysql_data[] = array(
            "id_cliente" => $idultimo
        );
    }
  } else if ($job == 'update_cliente') {
    $txtNombre = $_GET['txtNombre'];
    $txtPrimerApellido = $_GET['txtPrimerApellido'];
    $txtSegundoApellido = $_GET['txtSegundoApellido'];
    $txtUsername = $_GET['txtUsername'];
    $txtPassword = $_GET['txtPassword'];
    $idUsuario = $_GET['id_usuario'];

    $query = "UPDATE clientes ";
    $query .= "SET nombre = '".$txtNombre."', primer_apellido = '".$txtPrimerApellido."', segundo_apellido = '".$txtSegundoApellido."'";
    $query .= "WHERE id_cliente = ".$id;
    $resultado = mysqli_query($con, $query);

    $query2 = "UPDATE usuarios ";
    $query2 .= "SET username = '".$txtUsername."', password = '".$txtPassword."' ";
    $query2 .= "WHERE id_usuario = ".$idUsuario;
    $resultado2 = mysqli_query($con, $query2);

    if (!$resultado){
      $result  = 'error';
      $message = 'query error clientes';
    }else if(!$resultado2){
      $result  = 'error';
      $message = 'query error usuarios';
    }else{
        $result  = 'success';
        $message = 'query success';
    }
  }  else if ($job == 'delete_cliente') {
    $idUsuario = $_GET['id_usuario'];

    $query = "DELETE FROM clientes ";
    $query .= "WHERE id_cliente = ".$id;
    $resultado = mysqli_query($con, $query);

    $query2 = "DELETE FROM usuarios ";
    $query2 .= "WHERE id_usuario = ".$idUsuario;
    $resultado2 = mysqli_query($con, $query2);

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    }else if(!$resultado2){
      $result  = 'error';
      $message = 'query error usuarios';
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