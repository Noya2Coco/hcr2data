<?php
include '../scripts/sessionChecks.php';
?>


<!DOCTYPE html>
<html lang='en'>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <title>HCR2 | AdventureData</title>
        <link rel="icon" href="blackDatabase.ico" type="image/x-icon">
        <script>
            if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches){
                var favicon = document.querySelector("link[rel='icon']");
                favicon.href = "whiteDatabase.ico";
            }
        </script>
    </head>
    
    <body>
        
        <?php
        echo "Bienvenu " . ucfirst($_SESSION["username"]) . " !<br>";
        echo $_SESSION["connected"] ? "Connecté : True<br>" : "Connecté : False<br>";
        

        if ($_SESSION["connected"] == false){
            echo '<a href="includes/login.php"><button>Se connecter</button></a>';
        }
        else{
            echo '<a href="includes/logout.php"><button>Se déconnecter</button></a>';
        }
        ?>
        
        <div id="countdown">Temps restant avant la prochaine mise à jour : <span class="yellow-text">00:00:00</span></div>
        <script src="countdown.js"></script>
        
        <?php
        require '../vendor/autoload.php'; // Inclure l'autoloader de Composer

        use PhpOffice\PhpSpreadsheet\IOFactory;

        // Chemin vers le fichier Excel
        $chemin_fichier = '../DataFromHCR2Adventure/data/logs/adventureData.xlsx';

        try 
        {
            // Charger le fichier Excel
            $spreadsheet = IOFactory::load($chemin_fichier);

            // Sélectionner la première feuille de calcul
            $worksheet = $spreadsheet->getActiveSheet();

            // Récupérer les données de la feuille de calcul
            $donnees = $worksheet->toArray();

            echo '<table border="1">';

            // Boucle pour parcourir les lignes du tableau
            foreach ($worksheet->getRowIterator() as $row) {
                echo '<tr>';
    
                // Boucle pour parcourir les cellules de chaque ligne
                foreach ($row->getCellIterator() as $cell) {
                    $class = '';

                    // Obtenir les coordonnées de la cellule (par ex. A1, B2, etc.)
                    $cellCoordinate = $cell->getCoordinate();

                    // Obtenir la valeur de la cellule
                    $cellValue = $cell->getValue();

                    // Appliquer la classe 'yellow-text' aux cellules A2 et B1
                    if ($cellCoordinate == 'A2' || $cellCoordinate == 'B1') {
                        $class = 'yellow-text';
                    }
                    
                    // Appliquer la classe 'black-text' à la cellule A1
                    elseif ($cellCoordinate == 'A1') {
                        $class = 'black-text';
                    }

                    // Afficher la cellule avec la classe CSS appropriée
                    echo '<td class="' . $class . '">' . $cellValue . '</td>';
                }

                echo '</tr>';
            }

            echo '</table>';
            
        } 

        catch (Exception $e) 
        {
            echo 'Une erreur s\'est produite : ', $e->getMessage();
        }
        ?>
        
        
    </body>
</html>
