<?php
$acceptedLanguages = $_SERVER['HTTP_ACCEPT_LANGUAGE'];
$preferredLanguage = substr($acceptedLanguages, 0, 2);
$languageFile = 'en.php';

if ($preferredLanguage === 'fr') {
	$languageFile = 'en.php';
}

include_once('lang/' . $languageFile);

define('CURRENT_LANGUAGE', $preferredLanguage);
