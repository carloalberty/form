<?php
session_start();
  require 'config.php';
  //$hashed_password="userPass";
  if(isset($_POST['login'])) {
    $errMsg = '';
    // Get data from FORM
    $userEmail = $_POST['userEmail'];
    $userPass = $_POST['userPass'];
    if($userEmail == '')
      $errMsg = 'Ingrese un email';
    //if($userPass == '')
    if($userPass == '')
      $errMsg = 'Ingrese contraseña';
    if($errMsg == '') {
      try {
        $stmt = $pdo->prepare('SELECT userID, userName, userProfession, userCiudad, userPhone, userEmail, userPass, userPic FROM tbl_users WHERE userEmail = :userEmail');
        
        $stmt->execute(array(
          ':userEmail' => $userEmail, ':userPass' =>$userPass,));
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        if($data == false){
          $errMsg = "Email o Contraseña incorrectos";
        }
        else {
          if(password_verify($userPass, $data['userPass']))
          { 
            $_SESSION['name'] = $data['userEmail'];
            $_SESSION['userProfession'] = $data['userProfession'];
            $_SESSION['userPass'] = $data['userPass'];
            header('Location: panel_user2.php');
            exit;
          }
          else
            $errMsg = 'Password not match.';
        }
      }
      catch(PDOException $e) {
        $errMsg = $e->getMessage();
      }
    }
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
  .btn {
  background-color: #4285f4;
}

.btn:hover {
  background-color: #296CDB;
}

.btn:focus {
  background-color: #0F52C1;

  /* The outline parameter surpresses the border
  color / outline when focused */
  outline: 0;
}

.btn:active {
  background-color: #0039A8;
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
  

  <form action="checklogin.php" method="post" name="FormEntrar">
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-envelope"></i></span>
          <input type="email" class="form-control" name="userEmail" placeholder="email" id="email" aria-describedby="sizing-addon1" required>
        </div>
        <br>
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" name="userPass" class="form-control" placeholder="contraseña" aria-describedby="sizing-addon1" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="submit">Ingrese a su Panel</button>
        <br>
        <div class="opcioncontra"><a href="">Olvidaste tu contraseña?</a></div>
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