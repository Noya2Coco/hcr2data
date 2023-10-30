<?php
include_once('config.php');
?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="/style.css">
	</head>

	<body>
		<div class="navbar">
			<ul>
				<li>
					<a href="/">
						<?php 
						echo $lang['nav_home'];
						?>
					</a>
				</li>

				<li>
					<a href="/includes/dataMonthly.php">
						<?php
						echo $lang['nav_previous_months'];
						?>
					</a>
				</li>
				
				<?php 
				if (!$_SESSION["connected"]) {
					?>
					<li>
						<a href="/includes/login.php">
							<?php
								echo $lang['nav_login'];
							?>
						</a>
					</li>
					<?php
				}
				else {
					?>
					<li>
						<a href="#">
							<?php
								echo $lang['nav_export'];
							?>
						</a>
					</li>
					<li>
						<a href="#">
							<?php
								echo $lang['nav_waiting_data'];
							?>
						</a>
					</li>
					<li>
						<a href="#">
							<?php
								echo $lang['nav_all_data'];
							?>
						</a>
					</li>
					<li>
						<a href="/includes/logout.php">
							<?php
							echo $lang['nav_logout'];
							?>
						</a>
					</li>
					<?php
				}
				?>

			</ul>
		
		</div>


	</body>
</html>
