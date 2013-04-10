<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title>Manage Categories</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="category">
			<ul>
				<?php if(!empty($categories)): foreach ($categories as $category): ?>
						<form action="?" method="post">
							<div>
								<table width=500 >
										<tr><th style="width:125px;background-color:lightgrey;">Name</th><td style="border:none"><?php htmlout($category['name']); ?></td></tr>
										<tr><th style="background-color:lightgrey;">Description</th><td style="border:none"><?php htmlout($category['description']); ?></td></tr>
										<tr><th style="background-color:lightgrey;">Created On</th><td style="border:none"><?php htmlout($category['createdOn']); ?></td></tr>
										<tr><th style="background-color:lightgrey;">Last Date Altered</th><td style="border:none"><?php htmlout($category['alteredOn']); ?></td></tr>
										<tr><th style="background-color:lightgrey;">Creator</th><td style="border:none"><?php htmlout($category['userName']); ?></td></tr>
								</table>
							</div>
							<div style="margin-left:220px;">
								<input type="hidden" name="id" value="<?php
								echo $category['id']; ?>">
								<?php if(!$deletedForm):?><input type="submit" name="action" value="Edit"><?php endif ?>
								<?php if(!$deletedForm):?>
									<input type="submit" 
											name="action" 
											value="Delete" 
											onclick="return confirm('Are you sure you want to delete this item?');">
								<?php endif ?>
								<?php if($deletedForm):?>
									<input type="submit" 
											name="action" 
											value="UnDelete" 
											onclick="return confirm('Are you sure you want to Undelete this item?');">
								<?php endif ?>
							</div>
						</form>
						<hr>
				<?php endforeach;  endif;?>
			</ul>
		</div>
	</body>
</html>
