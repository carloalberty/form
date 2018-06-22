<?php
session_start();
if (isset($_SESSION['userEmail'])) {
	header('location: login1.php');
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
 "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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


<body>
<h1>dashboard</h1>

<div align="center">
    <div style=" border: solid 1px #006D9C;  align:left;">
      <?php
        if(isset($errMsg)){
          echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
        }
      ?>
      <div style="background-color:#006D9C; color:#FFFFFF; padding:10px;">Bienvenido  <b><?php echo $_SESSION['name']; ?></b></div>
      <div style="margin: 15px">
        Zona privada de edicion <br>
        
      </div>
    </div>
  </div>


 <br>

 <div class="col-sm-6 col-md-3">
<a href="perfil.php" class="btn btn-warning btn-lg btn-block active" role="button" aria-pressed="true">Tu Perfil</a>
</div>
  <div class="col-sm-6 col-md-3">
<a href="publicar-aviso.php" class="btn btn-warning btn-lg btn-block active" role="button" aria-pressed="true">Publicar..!!</a>
</div>
  <div class="col-sm-6 col-md-3">
<a href="modificar.php" class="btn btn-warning btn-lg btn-block active" role="button" aria-pressed="true">Modificar</a>
</div>
  <div class="col-sm-6 col-md-3">
<a href="logout.php" class="btn btn-danger btn-lg btn-block active" role="button" aria-pressed="true">Cerrar Sesion</a>
</div>

</div>
</div>
<br>

<!--FOOTER-->
<br><br>

<div style="width: 100%; min-height: 120px;background-color: #181719;margin: 0;">
<div class="container-fluid">
    <div class="footer">
      

      <div class="row text-center">
          <div class="col-md-4">
              <h4><a href="">Sobre Nosotros</a></h4>
              <h4><a href=""> Politica de Acuerdo</a></h4>
               <h4><a href="../legales/terminos-condiciones-de-uso.php">Condiciones de uso</a></h4>
          </div>
         <div class="col-md-4">
         </div>
         <div class="col-md-4">
         </div>
       </div>
   </div>
</div>

</div>

<!--FIN-FOOTER-->

</div>
</body>
</html>