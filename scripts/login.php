<?php
include '../../scripts/sessionChecks.php';
?>


<!DOCTYPE html>
<html lang='en'>
<head>
	
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/style.css">
	
	<title>Login : HCR2 | AdventureData</title>
	<link rel="icon" href="/blackDatabase.ico" type="image/x-icon">
	<script>
		if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
			var favicon = document.querySelector("link[rel='icon']");
			favicon.href = "/whiteDatabase.ico";
		}
	</script>
	
</head>
<body>
	
	<form method="POST" action="" align="center">
		<p class="form-title">Connection</p>
		<div class="form-group">
			<input type="text" name="username" size="20" maxlength="30" autocomplete="off" placeholder="Nom d'utilisateur">
		</div>
		<div class="form-group">
		<input type="password" name="password" size="12" maxlength="30" autocomplete="off" placeholder="Mot de passe">
		</div>
		
		<button type="submit" name="connexion">Envoyer</button>
	
	</form>
	
	<?php
	if ($_SESSION["connected"] === true){
		header("Location: /");
		exit;
	}

	if (isset($_POST["connexion"])){
		$username = htmlspecialchars($_POST['username']);
		$password = $_POST['password'];
		
		$connection = new mysqli("localhost", $username, $password, "adventure_data");
		
		if ($connection->connect_error){
			echo "Nom d'utilisateur ou mot de passe incorrect.";
		}
		else{
			$_SESSION["connected"] = true;
			$_SESSION["username"] = $username;
			header("Location: /");
			exit;
		}
	}
	?>
	
</body>
</html>
