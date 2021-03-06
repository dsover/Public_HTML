<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title><?php htmlout($pageTitle); ?></title>
		<script src="/javascript/javascript_form/gen_validatorv4.js" type="text/javascript"></script>
		</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="entryform">
			<form action="?<?php htmlout($action); ?>" id="categoryForm" method="post">
				<div>
					<label for="name">Name: <input type="text" name="name"
						id="name" value="<?php htmlout($name); ?>" placeholder="category name"></label>
					<label for="description">Description: <input type="text" name="description"
						id="description" value="<?php htmlout($description); ?>" placeholder="category description"></label>
				</div>
				<div>
					<input type="hidden" name="id" value="<?php htmlout($id); ?>">
					<input type="hidden" name="userId" value="<?php htmlout($_SESSION['userName']);?>">
					<input type="submit" value="<?php htmlout($button); ?>" onclick="return confirm('Are you sure you want to submit this item?');">
				</div>
			</form>
		</div>
		<script type="text/javascript">
			 var frmvalidator  = new Validator("categoryForm");
			frmvalidator.addValidation("name","req","Name Required");
			frmvalidator.addValidation("description","req","Description Required"); 
		</script>
	</body>
</html>
