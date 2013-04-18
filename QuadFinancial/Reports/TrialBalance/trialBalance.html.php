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
					<td colspan="3">
<?php if($printReport):?>
	<h4><pre >			
						QuadFinancial
						Trial Balance
						<?php htmlout(date("F d, Y"));?>
</pre></h4>
<?php else: ?>
		<h2>QuadFinancial</br>
			Trial Balance</br>
			<?php htmlout(date("F d, Y"));?></h2>
<?php endif ?>
					</td>
				</tr>
				<tr>
					<th></th>
					<th style="text-align:right;padding-right:4em"><u>Debits</u></th>
					<th style="text-align:right;padding-right:4em"><u>Credits</u></th>
				</tr>
				<tr>
					<td></td>
					<td style="text-align:right;padding-right:4em"></br></td>
					<td style="text-align:right;padding-right:4em"></td>
				</tr>
			<?php foreach($accounts as $account): ?>
				<?php if ($account['value'] != 0): ?>
				<tr>
					<td style="padding-left:6em"><?php htmlout($account['codeName']); ?></td>
					<td style="text-align:right;padding-right:4em"><?php if($account['creditOrDebit']== 'DEBIT'){if($firstDebit){htmlout("$"); $firstDebit = FALSE;}htmlout(curFormat($account['value']));}?></td>
					<td style="text-align:right;padding-right:4em"><?php if($account['creditOrDebit']== 'CREDIT'){if($firstCredit){htmlout("$"); $firstCredit = FALSE;}htmlout(curFormat($account['value']));}?></td>
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
					<td style="text-align:right;padding-right:4em">$<?php htmlout(curFormat($totalDebits)) ?></td>
					<td style="text-align:right;padding-right:4em">$<?php htmlout(curFormat($totalCredits)) ?></td>
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
