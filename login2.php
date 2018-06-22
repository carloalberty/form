<?php
session_start();
	require 'config.php';
	if(isset($_POST['login'])) {
		$errMsg = '';
		// Get data from FORM
		$userEmail = $_POST['userEmail'];
		$userPass = $_POST['userPass'];
		if($userEmail == '')
			$errMsg = 'Ingrese un email';
		if($userPass == '')
			$errMsg = 'Ingrese contraseña';
		if($errMsg == '') {
			try {
				$stmt = $pdo->prepare('SELECT userID, userName, userProfession, userCiudad, userPhone, userEmail, userPic FROM tbl_users WHERE userEmail = :userEmail AND userPass = :userPass');
				$stmt->execute(array(
					':userEmail' => $userEmail, ':userPass' =>$userPass,));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);
				if($data == false){
					$errMsg = "Email o Contraseña incorrectos";
				}
				else {
					if($userPas == $data['userPass']) {	
						$_SESSION['name'] = $data['userEmail'];
						$_SESSION['userProfession'] = $data['userProfession'];
						$_SESSION['userPass'] = $data['userPass'];
						header('Location: dashboard.php');
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

<html>
<head><title>Login</title></head>
	<style>
	html, body {
		margin: 1px;
		border: 0;
	}
	</style>
<body>
	<div align="center">
		<div style=" border: solid 1px #006D9C; " align="left">
			<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
			?>
			<div style="background-color:#006D9C; color:#FFFFFF; padding:10px;"><b>Login</b></div>
			<div style="margin: 15px">
				<form action="" method="post">
					<label>email</label>
					<input type="text" name="userEmail" value="<?php if(isset($_POST['userEmail'])) echo $_POST['userEmail'] ?>" autocomplete="off" class="box"/><br /><br />
					<label>contraseña</label>
					<input type="password" name="userPass" value="<?php if(isset($_POST['userPass'])) echo $_POST['userPass'] ?>" autocomplete="off" class="box" /><br/><br />
					<input type="submit" name='login' value="Login" class='submit'/><br />
				</form>
			</div>
		</div>
	</div>
</body>
</html>