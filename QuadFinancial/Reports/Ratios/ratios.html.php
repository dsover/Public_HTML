<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
		
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
		<?php if(!$fromHome){ include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php';} ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/Reports/flyout.html.php' ?>
		<div id="report">
			<table >
				<tr>
					<th style="text-align:left;padding-left:3em">Ratio</th>
					<th style="text-align:left">Value</th>
					<th>Status</th>
				</tr>
				<tr>
					<td>Debt To Equity Ratio:</td>
					<td><?php htmlout(ratFormat($debtToEquity)); ?></td>
					<td style="text-align:center"><img src="/QuadFinancial/images/<?php echo($debtToEquityColor);?>.jpg" alt="<?php echo($debtToEquityColor);?>" width="40" height="40"></td>
				</tr>
				<tr>
					<td>Current Ratio</td>
					<td><?php htmlout(ratFormat($current)); ?></td>
					<td style="text-align:center"><img src="/QuadFinancial/images/<?php echo($currentColor);?>.jpg" alt="<?php echo($currentColor);?>" width="40" height="40"></td>
				</tr>
				<tr>
					<td>Quick Ratio</td>
					<td><?php htmlout(ratFormat($quick)); ?></td>
					<td style="text-align:center"><img src="/QuadFinancial/images/<?php echo($quickColor);?>.jpg" alt="<?php echo($quickColor);?>" width="40" height="40"></td>
				</tr>
				<tr>
					<td>Return on Equity (ROE)</td>
					<td><?php htmlout(ratFormat($returnOnEquity)); ?></td>
					<td style="text-align:center"><img src="/QuadFinancial/images/<?php echo($returnOnEquityColor);?>.jpg" alt="<?php echo($returnOnEquityColor);?>" width="40" height="40"></td>
				</tr>
				<tr>
					<td>Net Profit Margin</td>
					<td><?php htmlout(ratFormat($netProfitMargin)); ?></td>
					<td style="text-align:center"><img src="/QuadFinancial/images/<?php echo($netProfitMarginColor);?>.jpg" alt="<?php echo($netProfitMarginColor);?>" width="40" height="40"></td>
				</tr>
			</table>
		</div>
	</body>
</html>
