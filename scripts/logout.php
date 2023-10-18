<?php
include '../../scripts/sessionChecks.php';

if ($_SESSION["connected"] === false){
	header("Location: /");
	exit;
}
else{
	$_SESSION["connected"] = false;
	$_SESSION["username"] = "guest";
	header("Location: /");
	exit;
}
