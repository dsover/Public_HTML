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
					<td colspan="3">
						<h2>QuadFinancial</br>
						Income Statment</br>
						December 31, 2011</h2>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Revenues</th>
					<th></th>
					<th></th>
			<?php foreach($revenues as $revenue): ?>
				<?php if ($revenue['value'] != 0): ?>
				<tr>
					<td style="padding-left:6em"><?php htmlout($revenue['codeName']); ?></td>
					<td style="text-align:right;"><?php htmlout($revenue['value']);?></td>
					<td style=""></td>
				</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td></td>
					<td style="text-align:right">--------------------------</td>
					<td style="text-align:center"></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:9em">Total Revenues</td>
					<td></td>
					<td style="text-align:right;padding-right:1em">$<?php htmlout($revTotal); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Expenses</th>
					<th></th>
					<th></th>
			<?php foreach($expenses as $expense): ?>
				<?php if ($expense['value'] != 0): ?>
				<tr>
					<td style="padding-left:6em"><?php htmlout($expense['codeName']); ?></td>
					<td style="text-align:right"><?php htmlout($expense['value']); ?></td>
					<td style=""></td>
				</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td></td>
					<td style="text-align:right">--------------------------</td>
					<td style="text-align:center"></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:9em">Total Expenses</td>
					<td></td>
					<td style="text-align:right;padding-right:1em">$<?php htmlout($expTotal); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:1em">--------------------------</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Net Income</td>
					<td></th>
					<th style="text-align:right;padding-right:1em">$<?php htmlout($netIncome); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:1em">===============</td>
				</tr>
			</table>
		</div>
	</body>
</html>
