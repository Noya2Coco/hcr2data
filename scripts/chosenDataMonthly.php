<?php
if (!isset($_GET['filePath'])){
	header("Location: /includes/dataMonthly.php");
	exit;
}
else {
	$filePath = $_GET['filePath'];
}

include 'navbar.php';
echo $filePath;
include 'showData.php';
