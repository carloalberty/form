<?php

  error_reporting( ~E_NOTICE );
  
  require_once 'config.php';
  
  if(isset($_POST['btnsave']))
  {
    $username = $_POST['user_name'];
    $userjob = $_POST['user_job'];
    $userciudad = $_POST['user_ciudad'];
    $userphone = $_POST['user_phone'];
    $useremail = $_POST['user_email'];
    $formpass = $_POST['user_pass'];
    $hash=password_hash($formpass, PASSWORD_BCRYPT);
    $fecha=date("Y-m-d H:i:s");
    //$salt = 'SHIFLETT';
    //$password_hash = hash('sha256', $salt . hash('sha256', $userPass . $salt));
   //$hashed_password = password_hash($_POST["userPass"],PASSWORD_DEFAULT);
    $imgFile = $_FILES['user_image']['name'];
    $tmp_dir = $_FILES['user_image']['tmp_name'];
    $imgSize = $_FILES['user_image']['size'];
    
    
    if(empty($username)){
      $errMSG = "Debe Ingresar un nombre.";
    }
    else if(empty($userjob)){
      $errMSG = "Por Favor Ingrese su Ocupacion.";
    }
    else if(empty($imgFile)){
      $errMSG = "Debe Seleccionar una Imagen de Perfil.";
    }
    else
    {
      $upload_dir = 'user_images/'; // upload directory
  
      $imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
    
      // valid image extensions
      $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
      // rename uploading image
      $userpic = rand(1000000,10000000).".".$imgExt;
        
      // allow valid image file formats
      if(in_array($imgExt, $valid_extensions)){     
        // Check file size '5MB'
        if($imgSize < 5000000)        {
          move_uploaded_file($tmp_dir,$upload_dir.$userpic);
        }
        else{
          $errMSG = "Su Imagen Seleccionada es Muy Pesada.";
        }
      }
      else{
        $errMSG = "Disculpe.. JPG, JPEG, PNG & GIF son los Formatos Permitidos.";   
      }
    }
    // if no error occured, continue ....
    if(!isset($errMSG)){
      $stmt = $pdo->prepare('INSERT INTO tbl_users(userName,userProfession,userCiudad,userPhone,userEmail,userPass, created, userPic) VALUES(:uname, :ujob, :uciudad, :uphone, :uemail, :upass, :ucreated, :upic)');
      $stmt->bindParam(':uname',$username);
      $stmt->bindParam(':ujob',$userjob);
      $stmt->bindParam(':uciudad',$userciudad);
      $stmt->bindParam(':uphone',$userphone);
      $stmt->bindParam(':uemail',$useremail);
      $stmt->bindParam(':ucreated',$fecha);
      $stmt->bindParam(':upass',$hash);
      $stmt->bindParam(':upic',$userpic); 
      if($stmt->execute())
      {
        $successMSG = "Datos Ingresados Correctamente ...";
        header("refresh:3; publicar.php"); // redirects image view page after 5 seconds.
      }
      else
      {
        $errMSG = "Ocurrio un error, Intente luego ....";
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
  <li class="inicio"><a href="../public/index.php">ezeizaweb</a></li>
  <li><a href="publicar.php">publicar</a></li>
  
</ul>
<style>
  .inicio a{
    background-color: #304ffe;
    color: #fff;
  }
  .ezeiza{
    font-family: 'Jua', sans-serif;
    font-size: 44px;
    color: #ff3d00;
  }
  .control-label{
    font-size: 1.6em;
        font-family: "Zilla Slab","Open Sans",X-LocaleSpecific,sans-serif;
  }
</style>
 
<div class="separa"></div>


<!-- menu-opciones-publicar -->

<div class="container-fluid">
       <div class="row text-center">
			
		
<div class="container">


  <div class="page-header">
      <h1 class="h2">Crea perfil de usuario.</h1>
    </div>
    

  <?php
  if(isset($errMSG)){
      ?>
            <div class="alert alert-danger">
              <span class="glyphicon glyphicon-info-sign"></span> <strong><?php echo $errMSG; ?></strong>
            </div>
            <?php
  }
  else if(isset($successMSG)){
    ?>
        <div class="alert alert-success">
              <strong><span class="glyphicon glyphicon-info-sign"></span> <?php echo $successMSG; ?></strong>
        </div>
        <?php
  }
  ?>   
 <div style=" border: solid 1px #006D9C;  align:left;">
<form method="post" enctype="multipart/form-data" class="form-horizontal">
      
  <table class="table table-bordered table-responsive">
  
    <tr>
      <td><label class="control-label">Nombre.</label></td>
        <td><input class="form-control" type="text" name="user_name" placeholder="Ingrese Su Nombre" value="<?php echo $username; ?>" /></td>
    </tr>
    
    <tr>
      <td><label class="control-label">Ocupacion.</label></td>
        <td><input class="form-control" type="text" name="user_job" maxlength="15" placeholder="Ingrese Su Ocupacion" value="<?php echo $userjob; ?>" /></td>
    </tr>

    <tr>
      <td><label class="control-label">Ciudad.</label></td>
        <td><input class="form-control" type="text" name="user_ciudad" placeholder="Ingrese Su Ciudad" value="<?php echo $userciudad; ?>" /></td>
    </tr>

    <tr>
      <td><label class="control-label">Telefono.</label></td>
        <td><input class="form-control" type="text" name="user_phone" placeholder="Ingrese Su Telefono" value="<?php echo $userphone; ?>" /></td>
    </tr>

    <tr>
      <td><label class="control-label">Email.</label></td>
        <td><input class="form-control" type="text" name="user_email" placeholder="Ingrese Su Email" value="<?php echo $useremail; ?>" /></td>
    </tr>

    <tr>
      <td><label class="control-label">Contraseña.</label></td>
        <td><input class="form-control" type="password" name="user_pass" placeholder="Ingrese Su Contraseña" value="<?php echo $userpass; ?>" /></td>
    </tr>
    
       <input type="hidden" name="created" value="fecha">

    <tr>
      <td><label class="control-label">Imagen de Perfil.</label></td>
        <td><input class="input-group" type="file" name="user_image" accept="image/*" /></td>
    </tr>
    
    <tr>
        <td colspan="2"><button type="submit" name="btnsave" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> &nbsp; registrarse
        </button>
        </td>
    </tr>
    
    </table>
    
</form>
</div>


<div class="alert alert-info">
    <strong>Al registrarse entendemos que acepta las </strong> <a href="../legales/terminos-condiciones-de-uso.php">condiciones de uso</a>!
</div>
</div>


		 <div class="aviso">
		 	<hr>
		<center> <h4>Recuerde que con su <strong><span style="color:red">Email y password</span></strong> tendra que ingresar nuevamente para completar su registro <br> por lo tanto mantenga sus datos de ingreso seguros.</h4></center>
		</div>
		<br><hr><br>

		<?php
include "../public/includes/footer.php";
		?>
</body>
 
</html>