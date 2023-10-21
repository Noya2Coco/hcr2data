<?php


if (isset($_GET['filePath'])){
	$filePath = $_GET['filePath'];
	echo $filePath;
}
else{
	header("Location: /includes/dataMonthly");
	exit;
}