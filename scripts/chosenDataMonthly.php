<?php
if (!isset($_GET['month'])){
	header("Location: /dataMonthly");
	exit;
}
else {
	$filePath = isset($_GET['month']) ? htmlspecialchars($_GET['month']) : '';
	$filePath = $filePath . '.xlsx';
}

$folderAndFilePath = ['dataMonthly/', $filePath];
include 'showData.php';
