<?php
session_start();
if (isset($_SESSION['userEmail'])) {
$userEmail = $_SESSION['userEmail'];
}
 else {
header('location: publicar.php');
}
	error_reporting( ~E_NOTICE );
	
	require_once 'config.php';
	
	if(isset($_GET['edit_id']) && !empty($_GET['edit_id']))
	{
		//$id = $_GET['edit_id'];
		$id = $_SESSION['userEmail'];
		$stmt_edit = $pdo->prepare('SELECT userName, userProfession, userPhone, userEmail, userPic FROM tbl_users WHERE userEmail =:uid');
		$stmt_edit->execute(array(':uid'=>$id));
		$edit_row = $stmt_edit->fetch(PDO::FETCH_ASSOC);
		extract($edit_row);
	}
	else
	{
		header("Location: publicar.php");
	}
	
	
	
	if(isset($_POST['btn_save_updates']))
	{
		$username = $_POST['user_name'];
		$userjob = $_POST['user_job'];
		$userphone = $_POST['user_phone'];
		$useremail = $_POST['user_email'];
			
		$imgFile = $_FILES['user_image']['name'];
		$tmp_dir = $_FILES['user_image']['tmp_name'];
		$imgSize = $_FILES['user_image']['size'];
					
		if($imgFile)
		{
			$upload_dir = 'user_images/'; // upload directory	
			$imgExt = strtolower(pathinfo($imgFile,PATHINFO_EXTENSION)); // get image extension
			$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
			$userpic = rand(1000,1000000).".".$imgExt;
			if(in_array($imgExt, $valid_extensions))
			{			
				if($imgSize < 5000000)
				{
					unlink($upload_dir.$edit_row['userPic']);
					move_uploaded_file($tmp_dir,$upload_dir.$userpic);
				}
				else
				{
					$errMSG = "Sorry, your file is too large it should be less then 5MB";
				}
			}
			else
			{
				$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";		
			}	
		}
		else
		{
			// if no image selected the old image remain as it is.
			$userpic = $edit_row['userPic']; // old image from database
		}	
						
		
		// if no error occured, continue ....
		if(!isset($errMSG))
		{
			$stmt = $pdo->prepare('UPDATE tbl_users 
									     SET userName=:uname, 
										     userProfession=:ujob,
										     userPhone=:uphone,
										     userEmail=:uid, 
										     userPic=:upic 
								       WHERE userEmail=:uid');
			$stmt->bindParam(':uname',$username);
			$stmt->bindParam(':ujob',$userjob);
			$stmt->bindParam(':uphone',$userphone);
			$stmt->bindParam(':uemail',$useremail);
			$stmt->bindParam(':upic',$userpic);
			$stmt->bindParam(':uid',$id);
				
			if($stmt->execute()){
				?>
                <script>
				alert('Successfully Updated ...');
				window.location.href='panel_user2.php';
				</script>
                <?php
			}
			else{
				$errMSG = "Sorry Data Could Not Updated !";
			}
		
		}
		
						
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Upload, Insert, Update, Delete an Image using PHP MySQL - Coding Cage</title>

<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">

<!-- Optional theme -->
<link rel="stylesheet" href="../crud/bootstrap/css/bootstrap-theme.min.css">

<!-- custom stylesheet -->
<link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified JavaScript -->
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="jquery-1.11.3-jquery.min.js"></script>
</head>
<body>
	<div class="contenedor">
<div class="navbar navbar-default navbar-static-top" role="navigation">
    <div class="container">
 
        <div class="navbar-header">
            <h2>ezeizaweb</h2>
            
        </div>
 
    </div>
</div>


<div class="container-fluid">
       <div class="row text-center">

          <div class="col-md-6">
<h2>ingreso usuario</h2>

<br><br>

<form method="post" enctype="multipart/form-data" class="form-horizontal">
	
    
    <?php
	if(isset($errMSG)){
		?>
        <div class="alert alert-danger">
          <span class="glyphicon glyphicon-info-sign"></span> &nbsp; <?php echo $errMSG; ?>
        </div>
        <?php
	}
	?>
   
    
	<table class="table table-bordered table-responsive">
	
    <tr>
    	<td><label class="control-label">Nombre</label></td>
        <td><input class="form-control" type="text" name="user_name" value="<?php echo $userName; ?>" required /></td>
    </tr>
    
    <tr>
    	<td><label class="control-label">Ocupacion</label></td>
        <td><input class="form-control" type="text" name="user_job" value="<?php echo $userProfession; ?>" required /></td>
    </tr>

     <tr>
    	<td><label class="control-label">Telefono</label></td>
        <td><input class="form-control" type="text" name="user_phone" value="<?php echo $userPhone; ?>" required /></td>
    </tr>
   
    <tr>
    	<td><label class="control-label">Email</label></td>
        <td><input class="form-control" type="text" name="user_email" value="<?php echo $userEmail; ?>" required /></td>
    </tr>

    <tr>
    	<td><label class="control-label">Imagen de perfil</label></td>
        <td>
        	<p><img src="user_images/<?php echo $userPic; ?>" height="150" width="150" /></p>
        	<input class="input-group" type="file" name="user_image" accept="image/*" />
        </td>
    </tr>

    <tr>
        <td colspan="2"><button type="submit" name="btn_save_updates" class="btn btn-default">
        <span class="glyphicon glyphicon-save"></span> Modificar
        </button>
        
        </td>
        <br>
<td>
         <a class="btn btn-default" href="panel_user2.php"> <span class="glyphicon glyphicon-backward"></span> Cancelar </a>
        
        </td>
    </tr>
    
    </table>
    
</form>

<br><br>
<div class="alert alert-info">
    <strong>Al publicar entendemos que acepta las </strong> <a href="http://www.codingcage.com/2016/02/upload-insert-update-delete-image-using.html">Condiciones de uso</a>!
</div>

</div>
</div>
</div>
</div>
<style>
	.contenedor{
		width: 90%;
		margin: o auto;
		padding: 10px 10px 0 10px;
	}
	tr,td{
		margin-top: 20px;
	}
	body{
		font-family: verdana;
	}
</style>
</body>
</html>