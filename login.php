<?php
session_start();
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
  <li><a href="../public/index.php">Inicio</a></li>
  <li><a href="../contacto/contacto.php">Contacto</a></li>
  <li class="publicar"><a href="#">publicar</a></li>
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


         <!-- formulario-login -->
          <div class="col-md-6">
<h2>ingreso usuario</h2>
            
         <div class="ContentForm">
      <form action="check-publicar.php" method="post" name="FormEntrar">
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-envelope"></i></span>
          <input type="email" class="form-control" name="email" placeholder="email" id="email" aria-describedby="sizing-addon1" required>
        </div>
        <br>
        <div class="input-group input-group-lg">
          <span class="input-group-addon" id="sizing-addon1"><i class="glyphicon glyphicon-lock"></i></span>
          <input type="password" name="pass" class="form-control" placeholder="contraseña" aria-describedby="sizing-addon1" required>
        </div>
        <br>
        <button class="btn btn-lg btn-primary btn-block btn-signin" id="IngresoLog" type="submit">Entrar</button>
        <br>
        <div class="opcioncontra"><a href="">Olvidaste tu contraseña?</a></div>
      </form>
     </div> 
     <!-- fin-formulario-login -->
          </div>
         <div class="col-md-6">
          <br>
          <hr>
          <h3>Date de alta en <br><span class="ezeiza">ezeizaweb</span><br> y publica alquileres, empleos, etc.</h3>
          <hr>
            <a href="registro-usuario.php" class="btn btn-warning btn-lg btn-block active" role="button" aria-pressed="true">registrate</a>
           
         </div>
         
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