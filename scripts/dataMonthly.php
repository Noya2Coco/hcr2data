<?php
include 'sessionChecks.php';
?>

<!DOCTYPE html>
<html lang='en'>
    <head>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="style.css">
        
        <title>Data : HCR2 | AdventureData</title>
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
	
		$folderPath = '../../data/dataMonthly';
		$files = scandir($folderPath);
		
		?>
		<table>
			<tr>
				<td class="table-title"></td>
				<td class="table-title">Janvier</td>
				<td class="table-title">Février</td>
				<td class="table-title">Mars</td>
				<td class="table-title">Avril</td>
				<td class="table-title">Mai</td>
				<td class="table-title">Juin</td>
				<td class="table-title">Juillet</td>
				<td class="table-title">Août</td>
				<td class="table-title">Septembre</td>
				<td class="table-title">Octobre</td>
				<td class="table-title">Novembre</td>
				<td class="table-title">Décembre</td>
			</tr>
			<tr>
		<?php
		
		$year = 22;
		$month = 0;
		
		foreach ($files as $file){			
			if ($file !== '.' && $file !== '..'){
				$fileYear = intval(substr($file, 0, 2));
				$fileMonth = intval(substr($file, 3, 5));
				$filePath = "/includes/chosenDataMonthly/";
				
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
					echo '<td><a href=' . $filePath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
					$month++;
				}
				elseif ($fileYear != $year){
					while ($month != 13){
						echo '<td class="any-data">Any Data</td>';
						$month++;
					}
					
					echo '</tr><tr>';
					$year++;
					$month = 0;
					
					if ($month == 0){
						echo '<td class="table-title">20' . $year . '</td>';
						$month++;
					}
				
					while ($fileMonth != $month){
						echo '<td class="any-data">Any Data</td>';
						$month++;
					}

					echo '<td><a href=' . $filePath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
					$month++;
				}
				elseif ($fileMonth != $month){
					while ($fileMonth != $month){
						echo '<td class="any-data">Any Data</td>';
						$month++;
					}
										
					echo '<td><a href=' . $filePath . '?filePath=' . $file . '>' . str_replace(".xlsx", "", $file) . '</td>';
					$month++;
				}
			}
		}
		
		echo '</tr></table>';
		?>
		
	</body>
</html>
