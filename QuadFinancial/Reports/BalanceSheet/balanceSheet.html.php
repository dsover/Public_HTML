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
						Balance Sheet</br>
						December 31, 2011</h2>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Assets</th>
					<th></th>
					<th></th>
			<?php foreach($assets as $asset): ?>
				<?php if ($asset['value'] != 0): ?>
					<tr>
						<td style="padding-left:6em"><?php htmlout($asset['codeName']); ?></td>
						<td style="text-align:right;padding-right:4em"><?php if($firstAsset){htmlout("$ "); $firstAsset = FALSE;} htmlout($asset['value']); ?></td>
						<td style=""></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td></td>
					<td style="text-align:right;padding-right:4em">------------------</td>
					<td></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:5em">Total Assets</td>
					<td></td>
					<th style="text-align:right;padding-right:5em">$ <?php htmlout($assetsTotal); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:5em">===============</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Liabilities</th>
					<th></th>
					<th></th>
			<?php foreach($liabilities as $liability): ?>
				<?php if ($liability['value'] != 0): ?>
					<tr>
						<td style="padding-left:6em"><?php htmlout($liability['codeName']); ?></td>
						<td style="text-align:right;padding-right:4em"><?php if($firstLiab){htmlout("$ "); $firstLiab = FALSE;}htmlout($liability['value']); ?></td>
						<td style=""></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td></td>
					<td style="text-align:right;padding-right:4em">------------------</td>
					<td style="text-align:center"></td>
				</tr>
				<tr>
					<td style="text-align:left;padding-left:4em">Total Liabilities</td>
					<td></td>
					<td style="text-align:right;padding-right:5em">$ <?php htmlout($liabTotal); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Stockholders' Equity</th>
					<th></th>
					<th></th>
			<?php foreach($shes as $she): ?>
				<?php if ($she['value'] != 0): ?>
					<tr>
						<td style="padding-left:6em"><?php htmlout($she['codeName']); ?></td>
						<td style="text-align:right;padding-right:4em"><?php if($firstShe){htmlout("$ "); $firstShe = FALSE;}htmlout($she['value']); ?></td>
						<td style=""></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td style="padding-left:6em">Retained Earnings</td>
					<td style="text-align:right;padding-right:4em"><?php htmlout($newRetained); ?></td>
					<td style=""></td>
				</tr>
				<tr>
					<td></td>
					<td style="text-align:right;padding-right:4em">------------------</td>
					<td style="text-align:center"></td>
				</tr>
				<tr>
					<td style="text-align:left;padding-left:4em">Total Stockholders Equity</td>
					<td></td>
					<td style="text-align:right;padding-right:5em"><?php htmlout($sheTotal); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-top:2em"></td>
					<td></th>
					<th></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Total S.H.E. and Liabilities</td>
					<td></th>
					<th style="text-align:right;padding-right:5em">$ <?php htmlout($sheAndLiabTotal); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:5em">===============</td>
				</tr>

			</table>
		</div>
	</body>
</html>
