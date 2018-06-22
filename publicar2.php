<?php

session_start();

  // check whether the loginbtn was clicked
if (isset($_POST['login'])) {

  include_once 'config.php';

    // initialize variable
  $userName = $_POST['userName'];
  $userPass = $_POST['userPass'];

    // error handlers

    // check if inputs are empty
  if (empty($userName) || empty($userPass)) {

    $pdo = null;
    header("Location: ../index.php?login=error_field");
    exit();

  } else {

      // check if username is in database
    $stmt = $pdo->prepare("SELECT userName FROM tbl_agentes WHERE  = ?");
    $stmt->execute([$userName]);

    if ($stmt->rowCount() < 1) {

      $pdo = null;
      header("Location: ../index.php?login=error_username");
      exit();

    } else {

        // check if password is correct
      $stmt = $pdo->prepare("SELECT userPass FROM tbl_users WHERE userName = ?");
      $stmt->execute([$userName]);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // dehashing the password
      $hashedPwdCheck = password_verify($pwd, $result[0]['userPass']);

      if ($hashedPwdCheck == false) {

        $pdo = null;
        header("Location: ../index.php?login=error_password");
        exit();

      } else {

          // login the user in
        $stmt = $pdo->prepare("SELECT userID, userName, userPhone, userEmail, userCiudad FROM tbl_users WHERE userName = ?");
        $stmt->execute([$userName]);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $_SESSION['userID'] = $result[0]['userID'];
        $_SESSION['userName'] = $result[0]['userName'];
        $_SESSION['userPhone'] = $result[0]['userPhone'];
        $_SESSION['userEmail'] = $result[0]['userEmail'];
        $_SESSION['userCiudad'] = $result[0]['userCiudad'];

        $pdo = null;
        header("Location: ../updates.php?login=success");
        exit();

      }

    }

  }

} else {

  header("Location: ../index.php?login=error");
  exit();

}

?>
<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link href="https://fonts.googleapis.com/css?family=Jua" rel="stylesheet">
 
  
    <link rel="shortcut icon" href="https://mdbootstrap.com/wp-content/themes/mdbootstrap4/favicon.ico" />

<link rel="stylesheet" href="../css/ezeiza.css">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css" >
<!-- Minified JS library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- Compiled and minified Bootstrap JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" ></script>
</head>
<body>

<div class="container">

 <ul class="navigation">
    <li class="publicar"><a href="../public/index.php">ezeizaweb</a></li>
  <li><a href="../contacto/contacto.php">Contacto</a></li>
</ul>
<style>
  .publicar a{
    background-color: #304ffe;
    color: #fff;
  }
  .ezeiza{
    font-family: 'Jua', sans-serif;
    font-size: 44px;
    color: #ff3d00;
  }
</style>
 
<div class="separa"></div>


<!-- menu-opciones-publicar -->

<div class="container-fluid">
       <div class="row text-center">

<hr>
         <!-- formulario-login -->
          <div class="col-md-6">
<h2>ingreso</h2>
            

    
      <?php
        if(isset($errMsg)){
          echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
        }
      ?>
  

<form action"" method="post" enctype="multipart/form-data" class="form-horizontal">
     

    <div style=" border: solid 2px #006D9C; " align="left">

  <table class="table table-bordered table-responsive">
  
    <tr>
      <td><label class="control-label-new">email.</label></td>

          <td><input class="form-control" type="text" name="userName" value="<?php if(isset($_POST['userName'])) echo $_POST['userName'] ?>" autocomplete="off" class="box"/></td>
          </tr>
          <tr>
          <td><label class="control-label-new">contraseña</label></td>
          <td><input class="form-control" type="password" name="userPass" value="<?php if(isset($_POST['userPass'])) echo $_POST['userPass'] ?>" autocomplete="off" class="box" /></td>
            </tr>
            <tr>
          <td colspan="2"><input class="form-control" type="submit" name='login' value="Login" class='submit'/></td>
          </tr></table>
          </div>
        </form>
      
 
</div>
<!--fin-formulario-login-->

<div class="col-md-6">
<br>
<h2>Nuevo Usuario</h2>

<h2><a href="../extras/registro-usuario.php" class="btn btn-info btn-lg btn-block active" role="button" aria-pressed="true"><span style="text-transform: uppercase">registrate aqui</span></a></h2>
<h3><span class="gratis">publica gratis</span>
<br><br>alquileres, empleos, servicios</h3>
</div>
<style>
  .gratis{
     font-family: 'Jua', sans-serif;
     font-size: 1.3em;
    font-weight: bolder;
    color: red;
  }
  .control-label-new{
    font-size: 1.3em;
    font-family: verdana;
   
  }
</style>


         
       </div>
<hr>
     
</div>

<!-- fin-menu-opciones -->


<div class="row">
  <?php
  include "../public/includes/footer.php"
  ?>
</div>

</div>
</body>
</html>