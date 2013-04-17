<?php 
	include $_SERVER['DOCUMENT_ROOT'] . 'includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/mpdf/mpdf.php';
	if (!userIsLoggedIn()){
		include '../login.html.php';
		exit();
	}


include 'faq.html.php'; 
?>


