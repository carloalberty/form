<?php
 $host_db = "localhost";
 $user_db = "root";
 $pass_db = "";
 $db_name = "reg_agentes";
 $tbl_name = "pdo";
 $conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);
 if ($conexion->connect_error) {
 die("La conexion falló: " . $conexion->connect_error);
}

 $buscarUsuario = "SELECT * FROM $tbl_name
 WHERE username = '$_POST[username]' ";
 $result = $conexion->query($buscarUsuario);
 $count = mysqli_num_rows($result);
 if ($count == 1) {
 echo "<br />". "El Nombre ingresado ya existe." . "<br />";
 echo "<a href='registro-usuario.php'>intente otra vez</a>";
 }
 else{ 
 $query = "INSERT INTO pdo (id, username, email, telefono, ciudad, password)
           VALUES ('','$_POST[username]','$_POST[email]','$_POST[telefono]','$_POST[ciudad]','$hash')";
 if ($conexion->query($query) === TRUE) {
 echo "<br />" . "<h2>" . "Usuario Creado Exitosamente!" . "</h2>";
 echo "<h4>" . "Bienvenido: " . $_POST['username'] . "</h4>" . "\n\n";
 echo "<h5>" . "Hacer Login: " . "<a href='publicar.php'>Login</a>" . "</h5>"; 
 }
 else {
 echo "Error al crear el usuario." . $query . "<br>" . $conexion->error; 
   }
 }
 mysqli_close($conexion);
?>