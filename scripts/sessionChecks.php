<?php
session_start();

if (!isset($_SESSION['username'])){
	$_SESSION["username"] = "guest";
}

if (!isset($_SESSION['connected'])){
	$_SESSION["connected"] = false;
}
