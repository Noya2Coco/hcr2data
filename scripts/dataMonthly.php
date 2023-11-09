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
				
			<?php
			$chosenPath = "/includes/chosenDataMonthly.php";
			
			$nameMonths = ['january', 'february', 'march', 'april', 'may', 'june', 
				'july', 'august', 'september', 'october', 'november', 'december'];
			$months = array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
			
			// Créez une nouvelle liste de noms de fichiers sans extension
			$filesName = [];
			foreach ($files as $fileName) {
				// Utilisez la fonction pathinfo pour extraire le nom de fichier sans extension
				$filesName[] = pathinfo($fileName, PATHINFO_FILENAME);
			}
			
			// Obtenez les années uniques à partir des noms de fichiers
			$years = array();
			foreach ($filesName as $fileName) {
				if (strpos($fileName, '-') !== false) {
					list($year, $month) = explode('-', $fileName);
					$years[$year] = true;
				}
			}
			

			// Créez dynamiquement les entrées du tableau pour chaque année et mois
			foreach (array_keys($years) as $year) {
				foreach ($months as $m) {
					$table[$year][$m] = '•';
				}
			}

			// Placez les noms de fichiers existants dans le table
			foreach ($filesName as $fileName) {
				if (strpos($fileName, '-') !== false) {
					list($year, $month) = explode('-', $fileName);
					$table[$year][$month] = $fileName;
				}
			}

			// Générez le table HTML
			echo '<tr><td class="table-title">' . $lang['month_year'] . '</td>';
			foreach (array_keys($table) as $year) {
				echo '<td class="table-title">20' . $year . '</td>';
			}
			echo '</tr>';
			foreach ($months as $m) {
				echo '<tr><td class="table-title">' . $lang[$nameMonths[intval($m) -1]] . '</td>';
				foreach (array_keys($table) as $year) {
					if ($table[$year][$m] === '•'){
						echo '<td><a class="any-data">' . $table[$year][$m] . '</a></td>';
					}
					else{
						echo '<td><a href=' . $chosenPath . '?filePath=' . $table[$year][$m] . '.xlsx>' . $table[$year][$m] . '</a></td>';
					}
				}
				echo '</tr>';
			}
			echo '</table>';
			?>
			<!--
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
						echo '<td class="table-title">' . '</td>';
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
		-->
		
		<script src="../checkScrollbar.js"></script>

	</body>
</html>
