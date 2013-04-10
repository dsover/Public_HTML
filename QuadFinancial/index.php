<?php

if(isset($_GET['forgotPassword'])){
$message = "Please Reset"."users account Password";
$message = wordwrap($message, 70, "\r\n");
$header = "From: [email]auto-confirm@mscreativedesigns.com[/email]\r\n";
mail('dsover@spsu.edu', 'QuadFinancial--PasswordReset', $message,$header);
}
if (isset($_POST['action']) and $_POST['action'] == 'userChangePassword'){
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php';
	include $_SERVER['DOCUMENT_ROOT'] . 'QuadFinancial/oldpasswordchange.form.html.php';
	exit();		
}
include 'home.html.php';
