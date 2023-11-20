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
        
        <title>Hcr2 Data</title>
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
		
		<div class="showTable">
			<div class="table-container">
					<p>
						<?php
						echo $lang['select_month'];
						?>
					</p>
				<table>
					<?php
					$chosenPath = "/chosenDataMonthly";
					
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
								echo '<td><a href=' . $chosenPath . '?month=' . $table[$year][$m] . '>' . $table[$year][$m] . '</a></td>';
							}
						}
						echo '</tr>';
					}
					
				?>
				</table>
			</div>
		</div>
		<script src="../checkScrollbar.js"></script>

	</body>
</html>
