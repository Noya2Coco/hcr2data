<?php
include 'sessionChecks.php';
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
        
        <title>Hcr2 Data</title>
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
			include 'navbar.php';
		?>

        <div id="countdown">
			<?php 
				echo $lang['next_update']; 
			?>
			<span class="countdown important-text">00:00:00</span>
		</div>
        <script src="countdown.js"></script>
        
		<div class="news-container">
			<div class="video-container">
				<?php
					echo '<p>' . $lang['the_news'] . '</p>';
				?>
				<iframe width="560" height="315" src="https://www.youtube.com/embed/C_TdUJ1VPOM?autoplay=1&controls=0&fs=0&iv_load_policy=3&loop=1&modestbranding=1&rel=0&color=white" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>
			</div>
			<div class="graph-container">
				<?php
					echo '<p>' . $lang['the_last_days'] . '</p>';
				?>
				<img src="/includes/graphRedirect.php?image=lastDay.png" alt='Graph of the last 5 days'>

			</div>
		</div>
		
		<?php
		
		echo '<br><br><br><br><br><br><br><br><br><br>';
		echo $lang['welcome'] . ucfirst($_SESSION["username"]) . " !<br>";
		echo $_SESSION["connected"] ? "Connecté : True<br>" : "Connecté : False<br>";
		
		
		require '../vendor/autoload.php'; // Inclure l'autoloader de Composer

        use PhpOffice\PhpSpreadsheet\IOFactory;
		
        // Chemin vers le fichier Excel
        $chemin_fichier = '../data/logs/adventureData.xlsx';

        try
        {
            // Charger le fichier Excel
            $spreadsheet = IOFactory::load($chemin_fichier);

            // Sélectionner la première feuille de calcul
            $worksheet = $spreadsheet->getActiveSheet();

            // Récupérer les données de la feuille de calcul
            $donnees = $worksheet->toArray();

            echo '<div class="table-container"><table>';

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
            
        } 

        catch (Exception $e) 
        {
            echo 'Une erreur s\'est produite : ', $e->getMessage();
        }
        ?>
        
        <script src="../checkScrollbar.js"></script>

    </body>
</html>
