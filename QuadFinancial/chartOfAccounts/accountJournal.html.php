
<?php include $_SERVER['DOCUMENT_ROOT'] . 'includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<title>Account Ledger</title>
	</head>
	<body>
		<p><?php include '../header.inc.html.php'; ?></a></p>
		<div id="ledger">
			<table id="<?php $_POST['name'] . 'Table' ?>" style="width:30%;min-width:400px">
				<tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">AccountName:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout($acctCode."-".$name); ?></td>
					</tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">AccountCategory:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout($categoryName); ?></td>
					</tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">Date Started:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout($CreatedOn);?></td>
					</tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">NormalBalance:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout($normBal);?></td>
					</tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">AccountType:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout($accountType); ?></td>
					</tr>
					<tr>
						<td style="background-color:lightgrey;text-align:right;padding-right:1em">CurrentBalance:</td>
						<td style="color:darkgreen;text-align:left;border:none;padding-left:1em"><?php htmlout("$ ".curFormat($totalSum)); ?></td>
					</tr>
				</tr>
			</table>
			<table style="table-layout: fixed;width:100%">
				<tr>
					<h1 style="column-span:all;text-align:center;"><?php htmlout($name) ?> Ledger</h1>
				</tr>
				<tr>
					<th style="background-color:lightgrey;width:5%">Journal #</th>
					<th style="background-color:lightgrey;width:10%">Date</th>
					<th style="background-color:lightgrey;width:15%">Debit</th>
					<th style="background-color:lightgrey;width:15%">Credit</th>
					<th style="background-color:lightgrey;width:20%">Document</th>
					<th style="background-color:lightgrey;width:35%">Description</th>
				</tr>
			<?php if(!empty($accountEntries)):
				 foreach($accountEntries as $line): ?>
				<tr>
					<td style="text-align:center;border:none"><?php htmlout($line['JournalId']) ?></td>
					<td style="text-align:center;border:none"><?php htmlout($line['date']) ?></td>
					<td style=";text-align:right;padding-right:5em;border:none"><?php if($line['debitOrCredit'] == "debit"){htmlout(curFormat($line['amount']));} ?></td>
					<td style=";text-align:right;padding-right:5em;border:none"><?php if($line['debitOrCredit'] == "credit"){htmlout(curFormat($line['amount']));} ?></td>
					<td style="border:none;padding-left:1em">
						<label for="file" ></label>
						<?php if($line['FileName']):?>
							<a href="?getFile=<?php htmlout($line['JournalId']); ?>"><?php htmlout($line['FileName']);?></a> 
						<?php else:
							htmlout('No File for this Post');?>
						<?php endif;?>
					</td>
					<td style="border:none;padding-left:1em">
							<?php htmlout($line['description']); ?>
					</td>
				</tr>
				<?php endforeach; 
			endif;?>
				<tr>
					<td style="border:none"></td>
					<td style="border:none"></td>
					<td style="text-align:right;padding-right:5em;border:none">----------------</td>
					<td style="text-align:right;padding-right:5em;border:none">----------------</td>
					<td style="border:none"></td>
					<td style="border:none"></td>
				</tr>
				<tr>
					<td style="border:none"></td>
					<th style="border:none;text-align:right;padding-right:5em;">Totals:</td>
					<th style="text-align:right;padding-right:5em;border:none"><?php htmlout(curFormat($totalDebits)) ?></td>
					<th style="text-align:right;padding-right:5em;border:none"><?php htmlout(curFormat($totalCredits)) ?></td>
					<td style="border:none"></td>
					<td style="border:none"></td>
				</tr>
				</tr>
								<tr>
					<td style="border:none"></td>
					<td style="border:none"></td>
					<th style="text-align:right;padding-right:5em;border:none"><?php if($totalDebits > $totalCredits){htmlout("==========");}?></td>
					<th style="text-align:right;padding-right:5em;border:none"><?php if($totalCredits > $totalDebits){htmlout("==========");}?></td>
					<td style="border:none"></td>
					<td style="border:none"></td>
				</tr>
				<tr>
					<td style="border:none"></td>
					<td style="border:none;text-align:right;padding-right:5em;"><b>Total Balance:</b></td>
					<th style="text-align:right;padding-right:5em;border:none"><?php if($totalDebits > $totalCredits){htmlout(curFormat($totalSum));}?></td>
					<th style="text-align:right;padding-right:5em;border:none"><?php if($totalCredits > $totalDebits){htmlout(curFormat($totalSum));}?></td>
					<td style="border:none"></td>
					<td style="border:none"></td>
			</table>
		</div>
	</body>
</html>
