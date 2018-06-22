<?php
session_start();
?>
<?php
$host_db = "localhost";
$user_db = "root";
$pass_db = "";
$db_name = "testdb";
$tbl_name = "tbl_users";
$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}
$userEmail = $_POST['userEmail'];
$userPass = $_POST['userPass'];
$sql = "SELECT * FROM $tbl_name WHERE userEmail = '$userEmail'";
$result = $conexion->query($sql);
if ($result->num_rows > 0) {     
 }
 $row = $result->fetch_array(MYSQLI_ASSOC);
 if (password_verify($userPass, $row['userPass'])) { 
    $_SESSION['loggedin'] = true;
    $_SESSION['userEmail'] = $userEmail;
    $_SESSION['start'] = time();
    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
    echo "Bienvenido! " . $_SESSION['userEmail'];

    header("Location: panel_user2.php");
    //echo "<br><br><a href='panel_user2.php'>Panel de Control</a>"; 

 } else { 
   echo "Nombre o Contraseña estan incorrectos.";

   echo "<br><a href='publicar.php'>Volver a Intentarlo</a>";
 }
 mysqli_close($conexion); 
 ?>