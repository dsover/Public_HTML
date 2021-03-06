<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title><?php htmlout($pageTitle); ?></title>
		<script src="/javascript/javascript_form/gen_validatorv4.js" type="text/javascript"></script>
		<style type="text/css">
			textarea {
				display: block;
				width: 100%;
			}
		</style>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="entryform">
			<form name="accountForm" id="accountForm" action="?<?php htmlout($action); ?>" method="post">
				<div>
					<label for="accountName">Account Name:</label>
					<input id="accountName" name="accountName" value="<?php htmlout($accountName); ?>" placeholder="account name">
				</div>
				<div>
					<label for="accountCode">Account Code:</label>
					<input id="accountCode" name="accountCode" value="<?php htmlout($accountCode); ?>" placeholder="account code">
				</div>
				<div>
					<label for="description">Description of Account: </label>
					<input id="description" name="description" value="<?php htmlout($description); ?>" placeholder="account description">
				</div>
				<fieldset style="width:600px">
					<legend>NormalBalance</legend>
						<div>
							<label for="normalBalance">
								<input type="radio" name="normalBalance" value="Credit" id="normalBalance" <?php if ( $normalBalance == "CREDIT"){htmlout('checked');}  ?> />Credit</br>
								<input type="radio" name="normalBalance" value="Debit" id="normalBalance" <?php if ( $normalBalance == "DEBIT"){htmlout('checked');}  ?>/>Debit</br>
						</div>
				</fieldset>
				<fieldset style="width:600px">
					<legend>Type</legend>
						<div>
							<label for ="type">
								<input type="radio" name="type" value="Asset" id="type" checked/>Asset</br>
								<input type="radio" name="type" value="Dividend" id="type" <?php if ( $type == "DIVIDEND"){htmlout('checked');}  ?>/>Dividend</br>
								<input type="radio" name="type" value="Expense" id="type" <?php if ( $type == "EXPENSE"){htmlout('checked');}  ?>/>Expense</br>
								<input type="radio" name="type" value="Liability" id="type" <?php if ( $type == "LIABILITY"){htmlout('checked');}  ?>/>Liability</br>
								<input type="radio" name="type" value="Revenue" id="type" <?php if ( $type == "REVENUE"){htmlout('checked');}  ?>/>Revenue</br>
								<input type="radio" name="type" value="SHE" id="type" <?php if ( $type == "SHE"){htmlout('checked');}  ?>/>SHE</br>
						</div>
				</fieldset>
				<fieldset style="width:600px">
					<legend>Categories:</legend>
						<?php for ($i = 0; $i < count($categories); $i++): ?>
							<div>
								<label for="categoryId <?php echo $i; ?>">
									<input type="radio"
										name="categoryId"
										value="<?php htmlout($categories[$i]['id']); ?>"
										id="categoryId"
										<?php	if ( $categoryId == $categories[$i]['id']){htmlout('checked');}  ?>/>
										<?php htmlout($categories[$i]['name']); ?></br>
							</div>
						<?php endfor; ?>
				</fieldset>
				<fieldset style="width:600px">
					<legend>Is Inventory:</legend>
						<div>
							<label for ="isInventory">
								<input type="radio" name="isInventory" value="1" id="type" <?php if ( $isInventory == 1){htmlout('checked');}  ?>/>Yes</br>
								<input type="radio" name="isInventory" value="0" id="type" <?php if ( $isInventory == 0){htmlout('checked');}  ?>/>No</br>
						</div>
				</fieldset>
				<div>
					<input type="hidden" name="userId" value="<?php htmlout($_SESSION['userName']);?>">
					<input type="hidden" name="id" value="<?php htmlout($id); ?>">
					<input type="submit" value="<?php htmlout($button); ?>">
				</div>
			</form>
		</div>
		<script type="text/javascript">
			 var frmvalidator  = new Validator("accountForm");
			frmvalidator.addValidation("accountName","req","Must enter a Name"); 
			frmvalidator.addValidation("accountCode","req","Must enter a Code"); 
			frmvalidator.addValidation("accountCode","numeric","Code must be a number");
			frmvalidator.addValidation("description","req","Must have a description");
			frmvalidator.addValidation("normalBalance","selone_radio","Must choose a Normal Balance");
			frmvalidator.addValidation("categoryId","selone_radio","Must choose a Category");
			frmvalidator.addValidation("type","selone_radio","Must choose a type");
			frmvalidator.addValidation("isInventory","selone_radio","Must choose a selection for Is Inventory");

		</script>
		<p><a href="previous.html" onClick="history.back();return false;">Exit</a></p>


	</body>
</html>
