<?php
$imageName = isset($_GET['image']) ? strval(htmlspecialchars($_GET['image'])) : '';

// Assurez-vous que le nom de l'image est valide et sécurisé
$imagePath = '../../data/graphMonthly/' . $imageName;

// Validation du nom de fichier (autorisez uniquement les caractères alphanumériques, tiret et point)
if (!preg_match('/^[a-zA-Z0-9-_.]+$/', $imageName)) {
    header('Location: /includes/error404.php');
    exit();
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
