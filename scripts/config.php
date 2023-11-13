<?php

$languageFile = 'en.php';
$preferredLanguage = 'en';

if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])){
	$acceptedLanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
	$preferredLanguage = substr($acceptedLanguages, 0, 2);
	
	if ($preferredLanguage === 'fr') {
		$languageFile = 'fr.php';
	}

	elseif ($preferredLanguage === 'es') {
		$languageFile = 'es.php';
	}
}

include_once('lang/' . $languageFile);

define('CURRENT_LANGUAGE', $preferredLanguage);
