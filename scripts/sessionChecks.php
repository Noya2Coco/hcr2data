<?php
session_start();

if (empty(session_id())){
	$_SESSION["connected"] = false;
	$_SESSION["username"] = "guest";
}
