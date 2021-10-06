<?php
include("./inc/settings.php");
//print_r($_POST);
$query="SELECT * FROM usuario WHERE EmployeeID = '$_POST[username]' AND EmployeePassword= md5('$_POST[pwd]')";
// echo $query;



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query($query);
//print_r($result);
if ($result->num_rows > 0) {
  
  // output data of each row
  $row = $result->fetch_assoc();
 // echo "Acceso de usuario validado, redirigiendo a la pagina principal.";
  session_start();
  $_SESSION["nombre"] = $row["EmployeeFirstName"];
  $_SESSION["apellido1"] = $row["EmployeeLastName1"];
  $_SESSION["apellido2"] = $row["EmployeeLastName2"];

  header("location: crud.php");

} else {
  echo "Se detecto un acceso ilegal al sistema, su ip esta siendo monitoreada y sera enviada a la policia";
  ?>
  <a href="https://noereynosoaguirre.000webhostapp.com/">Sitio de login</a>
  <?php
}
$conn->close();

?>
