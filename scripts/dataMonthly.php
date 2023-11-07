<?php
include 'sessionChecks.php';
include_once('config.php');
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
			 
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="/style.css">
        
        <title>HCR2 DATA</title>
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
        <?php
        include 'navbar.php';
	
		$folderPath = '../../data/dataMonthly';
		$files = scandir($folderPath);

		?>
		<div class="table-container">
			<table>
				<caption>
					<?php
					echo $lang['select_month'];
					?>
				</caption>
				
				<tr>
					<td class="table-title"></td>
					<td class="table-title">
						<?php
						echo $lang['january'];
						?>
					</td>
					<td class="table-title">
						<?php
						echo $lang['february'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['march'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['april'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['may'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['june'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['july'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['august'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['september'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['october'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['november'];
						?>
					</td>					
					<td class="table-title">
						<?php
						echo $lang['december'];
						?>
					</td>				
				</tr>
				<tr>
			<?php
			
			$year = 20;
			$month = 0;
			
			foreach ($files as $file){			
				if ($file !== '.' && $file !== '..'){
					$fileYear = intval(substr($file, 0, 2));
					$fileMonth = intval(substr($file, 3, 5));
					$chosenPath = "/includes/chosenDataMonthly.php";
					
					if ($month == 13){
						$year++;
						$month = 0;
						echo '</tr><tr>';
					}
					
					if ($month == 0){
						echo '<td class="table-title">20' . $year . '</td>';
						$month++;
					}
					
					if ($fileYear == $year && $fileMonth == $month){
						echo '<td><a href=' . $chosenPath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
						$month++;
					}
					elseif ($fileYear != $year){
						while ($fileYear != $year){
							echo '<td class="any-data">' . $lang['any_data'] . '</td>';
							$month++;
							
							if ($month == 13){
								echo '</tr><tr>';
								$year++;
								echo '<td class="table-title">20' . $year . '</td>';
								$month = 1;
							}
						}
					
						while ($fileMonth != $month){
							echo '<td class="any-data">' . $lang['any_data'] . '</td>';
							$month++;
						}

						echo '<td><a href=' . $chosenPath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
						$month++;
					}
					elseif ($fileMonth != $month){
						while ($fileMonth != $month){
							echo '<td class="any-data">' . $lang['any_data'] . '</td>';
							$month++;
						}
											
						echo '<td><a href=' . $chosenPath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
						$month++;
					}
				}
			}
			
			?>
			
				</tr>
			</table>
		</div>
		
		<script src="../checkScrollbar.js"></script>

	</body>
</html>
