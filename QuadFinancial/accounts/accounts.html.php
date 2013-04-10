<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title>Manage Accounts: Search Results</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="account">
			<?php if (isset($accounts)): ?>
			<ul>
				<?php foreach ($accounts as $account): ?>
					<form action="?" method="post">
						<div>
							<table width=500>
								<tr><th style="width:125px;background-color:lightgrey;">Name</th><td style="border:none"><?php htmlout($account['name']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Code</th><td style="border:none"><?php htmlout($account['code']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Description</th><td style="border:none"><?php htmlout($account['description']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Beginning Balance</th><td style="border:none"><?php htmlout($account['begBal']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Category</th><td style="border:none"><?php htmlout($account['catName']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Created By</th><td style="border:none"><?php htmlout($account['createdBy']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Created On</th><td style="border:none"><?php htmlout($account['createdOn']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">NormalBalance</th><td style="border:none"><?php htmlout($account['normalBalance']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Type</th><td style="border:none"><?php htmlout($account['type']); ?></td></tr>
								<tr><th style="background-color:lightgrey;">Is Inventory</th><td style="border:none"><?php if($account['isInventory'] == 1){htmlout("true");}else{htmlout("false");}?></td></tr>
							</table>
						</div>
						<div style="margin-left:220px;">
							<input type="hidden" 
								name="accountId" 
								value="<?php htmlout($account['id']); ?>">
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
				<?php endforeach; ?>
			<ul>
			<?php  else:?><div style="margin-left:180px"><p><?php htmlout('No results for entered criteria   ');?><a href="?">Try again</a></p></div><?php endif; ?>
		<div>
	</body>
</html>
