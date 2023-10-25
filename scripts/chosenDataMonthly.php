<?php
if (!isset($_GET['filePath'])){
	header("Location: /includes/dataMonthly.php");
	exit;
}
else {
	$filePath = $_GET['filePath'];
}

include 'navbar.php';
$folderAndFilePath = ['dataMonthly/', $filePath];
include 'showData.php';
