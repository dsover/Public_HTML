<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset="utf-8">
		<title>Access Denied</title>
	</head>
	<body>
		<h1>Access Denied</h1>
		<p><?php htmlout($error); ?></p>
			<li><a href="/QuadFinancial/"">I'll just go back home then</a></li>
	</body>
</html>
