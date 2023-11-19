<?php
$imageName = isset($_GET['image']) ? strval(htmlspecialchars($_GET['image'])) : '';

// Validation du nom de fichier (autorisez uniquement les caractères alphanumériques, tiret et point)
if (!preg_match('/^[a-zA-Z0-9-_.]+$/', $imageName)) {
    header('Location: /includes/error404.php');
    exit();
}

if ($imageName == 'lastDay.png') {
	$imagePath = '../../data/graphMonthly/lastDays/' . $imageName;
}
else {
	$imagePath = '../../data/graphMonthly/' . $imageName;
}

// Vérifiez que le fichier existe
if (file_exists($imagePath)) {
    $imageInfo = getimagesize($imagePath);
    header('Content-Type: ' . $imageInfo['mime']);
    readfile($imagePath);
    exit();
} else {
    header('Location: /includes/error404.php');
    exit();
}
