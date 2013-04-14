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
		<?php  if(!$printReport){include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php';} ?>
		<?php if(!$printReport){include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/Reports/flyout.html.php';} ?>
		<div <?php if($printReport){echo("id='reportPrint'");}else{echo("id='report'");}?>>
			<table <?php if($printReport){echo("id='reportPrint'");}?>>
				<tr>
					<td colspan="3">
<?php if($printReport):?>
	<h2><pre >			
				QuadFinancial
				Balance Sheet
				<?php htmlout(date("F d, Y"));?>
</pre></h2>
<?php else: ?>
		<h2>QuadFinancial</br>
			Balance Sheet</br>
			<?php htmlout(date("F d, Y"));?></h2>
<?php endif ?>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Assets</th>
					<th></th>
					<th></th>
			<?php foreach($assets as $asset): ?>
				<?php if ($asset['value'] > 0): ?>
					<tr>
						<td style="padding-left:6em"><?php htmlout($asset['codeName']); ?></td>
						<td style="text-align:right;padding-right:4em"><?php if($firstAsset){htmlout("$ "); $firstAsset = FALSE;} htmlout(curFormat($asset['value'])); ?></td>
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
					<th style="text-align:right;padding-right:5em">$ <?php htmlout(curFormat($assetsTotal)); ?></td>
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
						<td style="text-align:right;padding-right:4em"><?php if($firstLiab){htmlout("$ "); $firstLiab = FALSE;}htmlout(curFormat($liability['value'])); ?></td>
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
					<td style="text-align:right;padding-right:5em">$ <?php htmlout(curFormat($liabTotal)); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Stockholders' Equity</th>
					<th></th>
					<th></th>
			<?php foreach($shes as $she): ?>
				<?php if ($she['value'] != 0): ?>
					<tr>
						<td style="padding-left:6em"><?php htmlout($she['codeName']); ?></td>
						<td style="text-align:right;padding-right:4em"><?php if($firstShe){htmlout("$ "); $firstShe = FALSE;}htmlout(curFormat($she['value'])); ?></td>
						<td style=""></td>
					</tr>
				<?php endif ?>
			<?php endforeach ?>
				<tr>
					<td style="padding-left:6em">Retained Earnings</td>
					<td style="text-align:right;padding-right:4em"><?php htmlout(curFormat($newRetained)); ?></td>
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
					<td style="text-align:right;padding-right:5em"><?php htmlout(curFormat($sheTotal)); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-top:2em"></td>
					<td></th>
					<th></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Total S.H.E. and Liabilities</td>
					<td></th>
					<th style="text-align:right;padding-right:5em">$ <?php htmlout(curFormat($sheAndLiabTotal)); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:5em">===============</td>
				</tr>
			</table>
		</div>
		<?php if(!$printReport): ?>			
			<form action="?" id="printButton" method="post" name="print">
				<input type="submit" name="action" value="print"   
				onclick="print.target='POPUPW'; 
					POPUPW = window.open('about:blank','POPUPW','width=1600,height=1400');">
			</form>
		<?php endif ?>
	</body>
</html>
