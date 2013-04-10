<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset="utf-8">
		<title>Script Error</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<h1 style="color:#F2250A;">
			<?php echo $error; ?>
			</h1 >
				<a href="previous.html" onClick="history.back();return false;">Go back to do it again</a>
			</p>
		</p>
	</body>
</html>
