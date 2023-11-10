<?php
include 'sessionChecks.php';
include_once('config.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="/style.css">
	
    <title>
		<?php
		echo $lang['title_page_not_found'];
		?>
	</title>

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

	<div class="error_container">
		<h1 class="error">
			<?php
			echo $lang['error_404'];
			?>
		</h1>
		<p>
			<?php
			echo $lang['page_not_found'];
			?>
		</p>
		<button class="button-outside-form">
			<a href="/">
				<?php
				echo $lang['back_to_home_page'];
				?>
			</a>
		</button>
	</div>
	
</body>
</html>
