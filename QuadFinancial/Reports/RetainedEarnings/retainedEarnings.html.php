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
			<table>
				<tr>
					<td colspan="2" >
						<h2>QuadFinancial</br>
						Statment Of Retained Earnings</br>
						December 31, 2011</h2>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Retained Earnings-Begining</th>
					<td style="text-align:right;padding-right:4em">$ <?php htmlout($priorRetainedTotal); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Plus: Net Income</th>
					<td style="text-align:right;padding-right:4em"><?php htmlout($netIncome); ?></td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em">--------------------------</td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em"><?php htmlout($retainedAndIncome); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Less:Dividends</th>
					<td style="text-align:right;padding-right:4em"><?php htmlout($dividendTotal); ?></td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em">--------------------------</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Retained Earnings - Ending</th>
					<td style="text-align:right;padding-right:4em">$ <?php htmlout($newRetained ); ?></td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em">===============</td>
				</tr>
			</table>
		</div>
	</body>
</html>
