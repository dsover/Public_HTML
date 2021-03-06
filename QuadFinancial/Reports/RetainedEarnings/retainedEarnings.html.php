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
		<?php if(!$printReport): ?>			
			<form action="?" id="printButton" method="post" name="print">
				<input type="submit" name="action" value="print"   
				onclick="print.target='POPUPW'; 
					POPUPW = window.open('about:blank','POPUPW','width=1600,height=1400');">
			</form>
		<?php endif ?>
		<div <?php if($printReport){echo("id='reportPrint'");}else{echo("id='report'");}?>>
			<table <?php if($printReport){echo("id='reportPrint'");}?>>
				<tr>
					<td colspan="2" >
<?php if($printReport):?>
	<h4><pre >			
						QuadFinancial
						Retained Earnings
						<?php htmlout(date("F d, Y"));?>
</pre></h4>
<?php else: ?>
		<h2>QuadFinancial</br>
			Retained Earnings</br>
			<?php htmlout(date("F d, Y"));?></h2>
<?php endif ?>
					</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Retained Earnings-Begining</th>
					<td style="text-align:right;padding-right:4em">$ <?php htmlout(curFormat($priorRetainedTotal)); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Plus: Net Income</th>
					<td style="text-align:right;padding-right:4em"><?php htmlout(curFormat($netIncome)); ?></td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em">--------------------------</td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em"><?php htmlout(curFormat($retainedAndIncome)); ?></td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Less: Dividends</th>
					<td style="text-align:right;padding-right:4em"><?php htmlout(curFormat($dividendTotal)); ?></td>
				</tr>
				<tr>
					<th></th>
					<td style="text-align:right;padding-right:4em">--------------------------</td>
				</tr>
				<tr>
					<th style="text-align:left;padding-left:3em">Retained Earnings - Ending</th>
					<th style="text-align:right;padding-right:4em">$ <?php htmlout(curFormat($newRetained )); ?></th>
				</tr>
				<tr>
					<th></th>
					<th style="text-align:right;padding-right:4em">===============</th>
				</tr>
			</table>
		</div>
	</body>
</html>
