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
				Income Statement
				<?php htmlout(date("F d, Y"));?>
</pre></h2>
<?php else: ?>
		<h2>QuadFinancial</br>
			Income Statement</br>
			<?php htmlout(date("F d, Y"));?></h2>
<?php endif ?>
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
					<td style="text-align:right;"><?php if($firstRevenue){htmlout("$"); $firstRevenue = FALSE;}htmlout(curFormat($revenue['value']));?></td>
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
					<td style="text-align:right;padding-right:1em">$<?php htmlout(curFormat($revTotal)); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Expenses</th>
					<th></th>
					<th></th>
			<?php foreach($expenses as $expense): ?>
				<?php if ($expense['value'] != 0): ?>
				<tr>
					<td style="padding-left:6em"><?php htmlout($expense['codeName']); ?></td>
					<td style="text-align:right"><?php if($firstExpense){htmlout("$"); $firstExpense = FALSE;}htmlout(curFormat($expense['value'])); ?></td>
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
					<td style="text-align:right;padding-right:1em">$<?php htmlout(curFormat($expTotal)); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:1em">--------------------------</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Net Income</td>
					<td></th>
					<th style="text-align:right;padding-right:1em">$<?php htmlout(curFormat($netIncome)); ?></td>
				</tr>
				<tr>
					<td></td>
					<th></th>
					<th style="text-align:right;padding-right:1em">===============</td>
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
