<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'get_edificios'  || $job == 'add_edificio' || $job == 'update_edificio' || $job == 'delete_edificio') {
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
  if ($job == 'get_edificios'){     
    $query =  "SELECT id_edificio, nombre_edificio FROM edificios"; 

    $resultado = mysqli_query($con, $query);        
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';
    } else {
        $result  = 'success';
        $message = 'query success';         
        while ($row = mysqli_fetch_array($resultado)) {                                   
            $functions = '<a title="Editar edificio '.$row['id_edificio'].'" data-idedificio="'.$row['id_edificio'].'" data-nombreedificio="'.$row['nombre_edificio'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a> <a title="Eliminar edificio '.$row['id_edificio'].'" data-idedificio="'.$row['id_edificio'].'" class="btn-floating waves-effect waves-light blue modal-trigger function_delete" href="#">Eliminar</a>';
            $mysql_data[] = array(                           
            "id_edificio" => $row['id_edificio'],
            "nombre_edificio"     => $row['nombre_edificio'],
            "functions"  => $functions
            );
        }
    }    
  }  else if ($job == 'add_edificio') {

    $txtNombreEdificio = $_GET['txtNombreEdificio'];

    $query = "INSERT INTO edificios (nombre_edificio)";       
    $query .= " VALUES ";
    $query .= "('".$txtNombreEdificio."') ";    
    $resultado = mysqli_query($con, $query);       
    $idultimo = mysqli_insert_id($con); 

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';                
    } else {
        $result  = 'success';
        $message = 'query success';            
        
        $mysql_data[] = array(                           
            "id_edificio" => $idultimo
        );
    }    
  } else if ($job == 'update_edificio') {  
    $txtNombreEdificio = $_GET['txtNombreEdificio'];
              
    $query = "UPDATE edificios ";       
    $query .= "SET nombre_edificio = '".$txtNombreEdificio."' ";
    $query .= "WHERE id_edificio = ".$id." ";
    $resultado = mysqli_query($con, $query);            
    if (!$resultado){
        $result  = 'error';
        $message = 'query error';                
    } else {
        $result  = 'success';
        $message = 'query success';                       
    }    
  } else if ($job == 'delete_edificio') {  
              
    $query = "DELETE FROM edificios ";       
    $query .= "WHERE id_edificio = ".$id;
    $resultado = mysqli_query($con, $query);

    if (!$resultado){
        $result  = 'error';
        $message = 'query error';                
    } else {
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