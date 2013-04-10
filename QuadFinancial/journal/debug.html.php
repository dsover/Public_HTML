<?php 
				 include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<title>Script Error</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<p>
			<?php htmlout( var_dump($_POST['journalId'])); ?></br>


			<li><a href="previous.html" onClick="history.back();return false;">Go back to do it again</a></li>
		</p>
<?php

var_dump($_POST);

?>
	</body>
</html>
