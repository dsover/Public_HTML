<?php include_once $_SERVER['DOCUMENT_ROOT'] . 'includes/helpers.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/access.inc.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<title>Chart Of Accounts</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
	</head>
	<body>
		<?php include '../header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="chart">
			<?php $categoryNameFlag = 'xxx';
			 foreach ($accounts as $account): 
				if ($account['categoryName'] != $categoryNameFlag):?>
				<table id="<?php $account['categoryName'] . 'Table' ?>" width=70%>
					<tr >
						<th width=150 style="background-color:lightgrey;"><?php htmlout($account['categoryName']); ?></th>
						<th width=100 style="background-color:lightgrey;"><?php htmlout('Account'); ?></th>
						<th style="background-color:lightgrey;">Account Title</th>
					</tr>
					<?php endif;
					$categoryNameFlag = $account['categoryName']; ?>
					<form name= "?" action="?" method="post">
						<blockquote>
							<tr>
								<td style="border:none;text-align:center">
									<div>
										<input type="hidden" name="acctId" value="<?php htmlout($account['accountId']); ?>">
										<input type="submit" name="action" value="View"> </td>
									</div>
								<td style="border:none;text-align:left;padding-left:2em"><?php htmlout($account['accountCode']); ?></td>
								<td style="border:none;text-align:left;padding-left:2em"><?php htmlout($account['accountName']);?></td>
							</tr>
						</blockquote>
					</form>
			<?php endforeach; ?>
				</table>
		</div>
	</body>
</html>
