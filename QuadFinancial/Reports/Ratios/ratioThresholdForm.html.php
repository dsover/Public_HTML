<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title>Ratio Thresholds</title>
		<script src="/javascript/javascript_form/gen_validatorv4.js" type="text/javascript"></script>
		</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/Reports/flyout.html.php' ?>
		<form action="?updateThresholds" id="ratioForm" method="post">
			<div id="report">
				<table>
					<tr>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em">Name</td>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em">High</td>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em">Low</td>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em">IsHighBetter?</td>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em"></td>
						<td style="background-color:lightgrey;text-align:center;padding-left:2em;padding-right:2em">Last Editor</td>
				<?php if(!empty($Ratios)): ?>
						<?php foreach ($Ratios as $Ratio): ?>
							<form action="?" method="post">
									<tr>
										<td style="text-align:left;padding-left:2em;padding-right:2em"><input type="text" name="name" readonly value="<?php htmlout($Ratio['name']); ?>" </td>
										<td style="text-align:center;padding-left:2em;padding-right:2em"><input type="text" name="high" value="<?php htmlout($Ratio['high']); ?>"</td>
										<td style="text-align:center;padding-left:2em;padding-right:2em"><input type="text" name="low" value="<?php htmlout($Ratio['low']); ?>"</td>
										<td style="text-align:center;padding-left:1em;padding-right:1em">
														Yes<label for="higherIsBetter">
															<input type="radio" name="higherIsBetter" value = "1" id="higherIsBetter" 
																<?php if($Ratio['higherIsBetter'] ==1){htmlout('checked');}  ?>/>
														No<label for="higherIsBetter">
															<input type="radio" name="higherIsBetter" value = "0" id="higherIsBetter" 
																<?php if($Ratio['higherIsBetter'] ==0){htmlout('checked');}  ?>/>
										</td>
										<input type="hidden" name="id" value="<?php echo $Ratio['id']; ?>">
										<input type="hidden" name="uname" value="<?php echo $_SESSION['userName'] ?>">
										<td style="text-align:center;padding-left:2em;padding-right:2em"><input type="submit" name="action" value="update"></td>
										<td style="text-align:center;padding-left:2em;padding-right:2em"><?php htmlout($Ratio['lastEditor']);?></td>
									</tr>
							</form>
						<?php endforeach; else:?><p>No Ratios</p> <?php endif;?>
				</table>
			</div>
		</form>
		<script type="text/javascript">
			 var frmvalidator  = new Validator("ratioForm");
			frmvalidator.addValidation("low","req","Low Value Required");
			frmvalidator.addValidation("high","req","High Value Required");
		</script>
	</body>
</html>
