<?php
	include_once('config.php');
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4682722806417004"
    		 crossorigin="anonymous"></script>
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
    </head>
	
	<body>
		<?php
		require '../../vendor/autoload.php'; // Inclure l'autoloader de Composer

		use PhpOffice\PhpSpreadsheet\IOFactory;

		// Chemin vers le fichier Excel
		$chemin_fichier = '../../data/' . $folderAndFilePath[0] . $folderAndFilePath[1];
		$monthList = ["january", "february", "march", "april", "may", "june",
						"july", "august", "september", "october", "november", "december"];

		try
		{
			// Charger le fichier Excel
			$spreadsheet = IOFactory::load($chemin_fichier);

			// Sélectionner la première feuille de calcul
			$worksheet = $spreadsheet->getActiveSheet();

			// Récupérer les données de la feuille de calcul
			$donnees = $worksheet->toArray();

			echo '<div class="table-container"><table><caption>' 
				. $lang[$monthList[(int)substr($folderAndFilePath[1], 3, 2) -1]] 
				. ' 20' . substr($folderAndFilePath[1], 0, 2) . '</caption>';

			// Boucle pour parcourir les lignes du tableau
			foreach ($donnees as $rowIndex => $row) {
				echo '<tr>';
				$numColumns = 1;
				
				// Boucle pour parcourir les cellules de chaque ligne
				foreach ($row as $cellValue) {
					$class = '';

					// Appliquer la classe 'table-title' à la colonne A et à la ligne 1
					if ($rowIndex === 0 || $numColumns == 1){
						$class = 'table-title';
						echo '<td class="' . $class . ' column-' . $numColumns . '">' . $cellValue . '</td>';
					}
					
					elseif ($rowIndex === 1 && $numColumns != 1){
						$class = 'table-date';
						echo '<td class="' . $class . ' column-' . $numColumns . '">' . $cellValue . '</td>';
					}
					else {
						echo '<td class="' . $class . ' column-' . $numColumns . '">' . $cellValue . '</td>';
					}
					
					$numColumns += 1;
				}

				echo '</tr>';
			}

			echo '</table></div>';
			
			echo '<script src="../checkScrollbar.js"></script>';
			
		} 

		catch (Exception $e) 
		{
			echo 'Une erreur s\'est produite : ', $e->getMessage();
		}
		?>
