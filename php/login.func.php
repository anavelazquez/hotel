<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'login') {
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

if ($job != ''){

  $con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
  if (mysqli_connect_errno()){
    $result  = 'error';
    $message = 'Failed to connect to database: ' . mysqli_connect_error();
        $job     = '';
        LOGS($con, $message, $result, 0, "usuario log", 0, "rol log");
  }

  mysqli_set_charset($con,"utf8");

  // Execute job
  if ($job == 'login'){ 

      if (isset($_GET['txtUsuario'])) { $usuario = $_GET['txtUsuario']; }
      if (isset($_GET['txtContrasena'])) { $password = $_GET['txtContrasena']; }        

      $queryusr = "SELECT id_usuario, id_rol, username
                  FROM usuarios 
                  WHERE username= '".$usuario."' AND password='".$password."'"; 

      $resusr = mysqli_query($con, $queryusr);

      if(!empty($resusr) AND mysqli_num_rows($resusr) > 0){       
          if (!$resusr){
              $result  = 'error';
              $message = 'query error';
          } else {
              $result  = 'success';
              $message = 'query valido usuario';

              $rowpwd=mysqli_fetch_array($resusr);
                                  
              $mysql_data[] = array(        
                  "id_usuario" => $rowpwd['id_usuario'],
                  "id_rol" => $rowpwd['id_rol'],
                  "username" => $rowpwd['username'],
              );

          }   
      } else {
          $result  = 'error';
          $message = 'Los datos del usuario son incorrectos';
      }                                
  }     
  // Close database connection
  mysqli_close($con);
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