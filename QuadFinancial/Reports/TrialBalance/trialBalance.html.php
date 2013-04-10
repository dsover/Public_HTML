<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title>Reports</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/Reports/flyout.html.php' ?>
		<div id="report">
			<table >
				<tr>
					<td colspan="3">
						<h2>QuadFinancial</br>
						Trial Balance</br>
						December 31, 2011</h2>
					</td>
				</tr>
				<tr>
					<th></th>
					<th style="text-align:right;padding-right:4em">Debits</th>
					<th style="text-align:right;padding-right:4em">Credits</th>
			<?php foreach($accounts as $account): ?>
				<?php if ($account['value'] != 0): ?>
				<tr>
					<td style="padding-left:6em"><?php htmlout($account['codeName']); ?></td>
					<td style="text-align:right;padding-right:4em"><?php if($account['creditOrDebit']== 'DEBIT'){if($firstDebit){htmlout("$"); $firstDebit = FALSE;}htmlout($account['value']);}?></td>
					<td style="text-align:right;padding-right:4em"><?php if($account['creditOrDebit']== 'CREDIT'){if($firstCredit){htmlout("$"); $firstCredit = FALSE;}htmlout($account['value']);}?></td>
				</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td></td>
					<td style="text-align:right;padding-right:4em">-----------------</td>
					<td style="text-align:right;padding-right:4em">-----------------</td>
				</tr>
				<tr>
					<th></td>
					<td style="text-align:right;padding-right:4em">$<?php htmlout($totalDebits) ?></td>
					<td style="text-align:right;padding-right:4em">$<?php htmlout($totalCredits) ?></td>
				</tr>
				<tr>
					<td></th>
					<td style="text-align:right;padding-right:4em">============</th>
					<td style="text-align:right;padding-right:4em">============</th>
				</tr>

			</table>
		</div>
	</body>
</html>
