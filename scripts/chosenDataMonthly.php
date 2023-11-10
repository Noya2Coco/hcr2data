<?php
if (!isset($_GET['filePath'])){
	header("Location: /dataMonthly");
	exit;
}
else {
	$filePath = $_GET['filePath'];
}

$folderAndFilePath = ['dataMonthly/', $filePath];
include 'showData.php';
