<?php
        require '../vendor/autoload.php'; // Inclure l'autoloader de Composer

        use PhpOffice\PhpSpreadsheet\IOFactory;

		////////////////////////////////////////////
		/////////////////////////////////////////////
		
		// Chemin vers le fichier Excel
        $chemin_fichier = '../data/dataMonthly/23-10.xlsx';

         try
        {
            // Charger le fichier Excel
            $spreadsheet = IOFactory::load($chemin_fichier);

            // Sélectionner la première feuille de calcul
            $worksheet = $spreadsheet->getActiveSheet();

            // Récupérer les données de la feuille de calcul
            $donnees = $worksheet->toArray();
			
			$data = [];
			
            // Boucle pour parcourir les lignes du tableau
            foreach ($donnees as $rowIndex => $row) {
                $numColumns = 1;
                
				if ($rowIndex === 2){
					
					// Boucle pour parcourir les cellules de chaque ligne
					foreach ($row as $cellValue) {

						if ($numColumns != 1 && $cellValue !== null){
							array_push($data, $cellValue);
						}
						$numColumns += 1;
					}
				}
            }
			
            // Créer une image avec des dimensions spécifiques (largeur x hauteur)
			$largeur = 400;
			$hauteur = 300;
			$image = imagecreate($largeur, $hauteur);

			// Définir les couleurs
			$blanc = imagecolorallocate($image, 255, 255, 255);
			$bleu = imagecolorallocate($image, 0, 0, 255);

			// Définir les dimensions du graphique
			$espace_barre = 50; // Espace entre les barres
			$largeur_barre = ($largeur - ($espace_barre * count($data))) / count($data);

			// Déterminer les valeurs minimales et maximales
			$valeur_minimale = min($data);
			$valeur_maximale = max($data);

			
			// Définir les dimensions du graphique en fonction des valeurs minimales et maximales
			$hauteur_graphique = $hauteur - 20; // Hauteur totale du graphique
			$echelle_y = $hauteur_graphique / ($valeur_maximale - $valeur_minimale);

			// Dessiner les barres en utilisant l'échelle
			for ($i = 0; $i < count($data); $i++) {
				$hauteur_barre = ($data[$i] - $valeur_minimale) * $echelle_y;
				$x = $i * ($largeur_barre + $espace_barre);
				$y = $hauteur - $hauteur_barre - 10; // Décaler la barre vers le haut
				imagefilledrectangle($image, $x, $y, $x + $largeur_barre, $y + $hauteur_barre, $bleu);

				// Afficher la valeur sous la barre
				$valeur = $data[$i];
				$texte_x = $x + ($largeur_barre / 2) - 10; // Ajuster la position du texte
				$texte_y = $y + $hauteur_barre + 15; // Position sous la barre
				imagestring($image, 5, $texte_x, $texte_y, $valeur, $blanc);
			}
		
			// En-tête HTTP pour indiquer que l'image générée est une image PNG
			header('Content-type: image/png');

			// Afficher l'image
			imagepng($image);

			// Libérer la mémoire
			imagedestroy($image); 
        } 

        catch (Exception $e) 
        {
            echo 'Une erreur s\'est produite : ', $e->getMessage();
        }