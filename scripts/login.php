<?php
include 'sessionChecks.php';
include_once('config.php');
?>


<!DOCTYPE html>
<html lang='en'>
	<head>
		
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="/style.css">
		
		<title>Login : Hcr2 Data</title>
		<link rel="icon" href="/blackDatabase.ico" type="image/x-icon">
		<script>
			if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
				var favicon = document.querySelector("link[rel='icon']");
				favicon.href = "/whiteDatabase.ico";
			}
		</script>
		
		<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4682722806417004"
    		 crossorigin="anonymous">
		</script>
		
	</head>
	<body>
		
		<form method="POST" action="" align="center">
			<p class="form-title">
				<?php
					echo $lang['login'];
				?>
			</p>
			
			<div class="form-group">
				<input type="text" name="username" size="20" maxlength="30" autocomplete="off" placeholder=
					<?php
						echo '"'. $lang['username'] . '"';
					?>
				>
			</div>
			<div class="form-group">
			<input type="password" name="password" size="12" maxlength="30" autocomplete="off" placeholder=
					<?php
						echo '"' . $lang['password'] . '"';
					?>
				>
			</div>
			
			<button type="submit" name="connexion">
				<?php
					echo $lang['send'];
				?>
			</button>
		
		</form>
		
		<?php
		if ($_SESSION["connected"] === true){
			header("Location: /");
			exit;
		}

		if (isset($_POST["connexion"])){
			$username = htmlspecialchars($_POST['username']);
			$password = $_POST['password'];
			
			$connection = new mysqli("127.0.0.1", $username, $password, "adventuredata");
		
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
