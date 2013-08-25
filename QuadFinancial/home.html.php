<?php include_once '../includes/helpers.inc.php';
	require_once '../includes/access.inc.php'; ?>
<!DOCTYPE html>
<html lang="en"> 
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset ="utf-8">
		<title>QuadAdministrator</title>
	</head>
	<body>

		<?php if (!userIsLoggedIn()){ include 'header.inc.html.php';} ?>
		
		<?php 
			if (userHasRole(1) ){
				 include 'Reports/Ratios/index.php'; 
			}else {
				include 'journal/index.php';
			}
		?>
	</body>
</html>
