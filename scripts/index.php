<?php
include 'sessionChecks.php';
?>


<!DOCTYPE html>
<html lang='en'>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <title>HCR2 | AdventureData</title>
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
        
        echo "<br>Bienvenu " . ucfirst($_SESSION["username"]) . " !<br>";
        echo $_SESSION["connected"] ? "Connecté : True<br>" : "Connecté : False<br>";
        

        if ($_SESSION["connected"] == false){
            echo '<a href="includes/login.php"><button class="button-outside-form">Se connecter</button></a>';
        }
        else{
            echo '<a href="includes/logout.php"><button class="button-outside-form">Se déconnecter</button></a>';
        }
        ?>
        
        <div id="countdown">Temps restant avant la prochaine mise à jour : <span class="yellow-text">00:00:00</span></div>
        <script src="countdown.js"></script>
        
        <?php
        require '../vendor/autoload.php'; // Inclure l'autoloader de Composer

        use PhpOffice\PhpSpreadsheet\IOFactory;

        // Chemin vers le fichier Excel
        $chemin_fichier = '../DataFromHCR2Adventure/data/logs/adventureData.xlsx';

        try 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
        {
            // Charger le fichier Excel
            $spreadsheet = IOFactory::load($chemin_fichier);

            // Sélectionner la première feuille de calcul
            $worksheet = $spreadsheet->getActiveSheet();

            // Récupérer les données de la feuille de calcul
            $donnees = $worksheet->toArray();

            echo '<table>';

            // Boucle pour parcourir les lignes du tableau
            foreach ($donnees as $rowIndex => $row) {
                echo '<tr>';
                $numColumns = 1;
                
                // Boucle pour parcourir les cellules de chaque ligne
                foreach ($row as $cellValue) {
                    $class = '';

                    // Appliquer la classe 'yellow-text' aux cellules A2 et B1
                    if (($rowIndex === 1 && $cellValue === $donnees[1][0]) || ($rowIndex === 0 && $cellValue === $donnees[0][1])) {
                        $class = 'yellow-text';
                    }
                    
                    // Afficher la cellule avec la classe CSS appropriée
                    echo '<td class="' . $class . ' column-' . $numColumns . '">' . $cellValue . '</td>';
                    
                    $numColumns += 1;
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
