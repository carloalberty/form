<?php
session_start();
if (isset($_SESSION['userEmail'])) {
$userEmail = $_SESSION['userEmail'];
}
 else {
header('location: publicar.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
   <link type="text/css" rel="stylesheet" href="../css/materialize.css"  media="screen,projection"/>

<link href="estilo-panel.css" type="text/css" rel="stylesheet" media="screen,projection"/>
   
 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" >

  <title>Panel de agente</title>
  <style>
  body {
    width: 90%;
    margin: 0 auto;
    font-family: verdana;
    font-size: 12px;
    padding: 20px 30px 0 30px;
    text-align: center;
}
h3 {
    font-size: 2.92rem;
    line-height: 110%;
    margin: 1.9466666667rem 0 1.168rem 0;
}

table {
    width: 100%;
    display: table;
    border-collapse: collapse;
    border-spacing: 0;
    border: none;
}
  .container {
    margin: 0 auto;
    max-width: 1280px;
    width: 96%;
}
  .row {
    margin-left: auto;
    margin-right: auto;
    margin-bottom: 20px;
}
    .status-ok{
      color: green;
    }
     .status{
      color: red;

    }
      tr { border-bottom: 1px solid rgba(0, 0, 0, 0.12);}
      tr {
    display: table-row;
    vertical-align: inherit;
    border-color: inherit;
}
td, th {
    padding: 15px 5px;
    display: table-cell;
    text-align: left;
    vertical-align: middle;
    border-radius: 2px;
    font-size: 1.4em;
    margin-left: 20px;
}
.page-footer{
  width: 100%;
  min-height: 130px;
margin-top:30%;
  
}
  </style>

</head>
<body>
<div class="container">
    <h3>panel de control</h3>
<div class="row">
    

<?php
$link = mysqli_connect("localhost", "root", "", "testdb");
 
// Check connection
if($link === false){
    die("ERROR: Could not connect. " . mysqli_connect_error());
}
 
// Attempt select query execution
$sql = "SELECT * FROM tbl_users WHERE userEmail='$userEmail'";
if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) > 0){
      //new
     
        //new
        echo "<table>";
            echo "<tr>";
                echo "<th>NOMBRE</th>";
                echo "<th>EMAIL</th>";
                echo "<th>TELEFONO</th>";
                echo "<th>CIUDAD</th>";
                echo "<th>STATUS</th>";
            echo "</tr>";
        while($row = mysqli_fetch_array($result)){
            echo "<tr>";
                echo "<td>" . $row['userName'] . "</td>";
                echo "<td>" . $row['userEmail'] . "</td>";
                echo "<td>" . $row['userPhone'] . "</td>";
                echo "<td>" . $row['userCiudad'] . "</td>";
                echo "<td class='status-ok'>" . $row['userStatus'] . "</td>";
               
                
            echo "</tr>";
        }
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
}
//new

//new
        
     else{
        echo "No se encontraron registros.";
    }
} else {
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
}
// Close connection
mysqli_close($link);

?>
</div>
</div>
<div class="row text-center">
 <div class="col-md-4">
         <a class="btn btn-info" href="modificar-datos.php?edit_id=<?php echo $_SESSION['userEmail']; ?>" title="click for edit">
          <span class="glyphicon glyphicon-edit"></span> Publicar Aviso</a>
        </div>

        <div class="col-md-4">
         <a class="btn btn-info" href="modificar-datos.php?edit_id=<?php echo $_SESSION['userEmail']; ?>" title="click for edit">
          <span class="glyphicon glyphicon-edit"></span> Ver Publicados</a>
        </div>        

       <div class="col-md-4"> 
        <a class="btn btn-info" href="modificar-datos.php?edit_id=<?php echo $_SESSION['userEmail']; ?>" title="click for edit">
          <span class="glyphicon glyphicon-edit"></span> Editar Perfil</a>  
      </div>
        
  </div>     
   </div>

 <footer class="page-footer">
  <hr>
    <div class="container">
      <div class="row text-center">
        <div class="col-md-12">
       
         <a href="logout.php" class="btn btn-success btn-lg" role="button">SALIR</a>
        </div>
        
      </div>
    </div>
    <hr>
    <div class="footer-copyright">
      <div class="container">
      <p>@copyright &nbsp &nbsp Ezeizaweb</p>   
      </div>
    </div>
  </footer>


</body>
</html>