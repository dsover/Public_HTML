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
	</head>
	<body>
	<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="entryform">
			<form action="?<?php htmlout($action); ?>" id="?<?php htmlout($action); ?>" method="post">
				<div>
					<label for="userName">User Name: <input type="text" name="userName"
						id="userName"  value="<?php htmlout($userName); ?>" placeholder="username"></label>
				</div>
				<div>
					<label for="password">Set password: <input type="password" id="password"
						name="password" id="password" placeholder="password"></label>
					<label for="passwordConfirm">Confirm password: <input type="password" id="passwordConfirm"
						name="passwordConfirm" id="passwordConfirm" placeholder="confirm password"></label>
					</br>Reset Password on Next Login?
					<div>Yes<label for="resetFlag"><input type="radio" name="resetFlag" value = "1" id="resetFlag" <?php if($resetFlag ==1){htmlout('checked');}  ?>/>
					No<label for="resetFlag"><input type="radio" name="resetFlag" value = "0" id="resetFlag" <?php if($resetFlag ==0){htmlout('checked');}  ?>/></div>
				</div>
					<fieldset>
						<legend>Roles:</legend>
							<?php for ($i = 0; $i < count($roles); $i++): ?>
								<div>
									<label for="role<?php echo $i; ?>">
										<input type="radio" 
											name="role" 
											value="<?php htmlout($roles[$i]['id']); ?>"
											 id="role"
											<?php if($roles[$i]['selected']==$roles[$i]['id']){htmlout('checked');}  ?>/> <?php htmlout($roles[$i]['name']);?></br>
								</div>
							<?php endfor; ?>
					</fieldset>
				<div>
					<input type="hidden" name="id" value="<?php htmlout($id); ?>">
					<input type="submit" value="<?php htmlout($button); ?>">
				</div>
			</form>
			<?php if($action== 'addform'):?>
				<script type="text/javascript">
					 var frmvalidator  = new Validator("?addform");
					frmvalidator.addValidation("userName","req","Must have a User Name");
					frmvalidator.addValidation("password","req","Must have a Password");
					frmvalidator.addValidation("password","minlength=8","Password Must be at least 8 digits");
					frmvalidator.addValidation("password","eqelmnt=passwordConfirm","Passwords Don't Match"); 
					frmvalidator.addValidation("role","selone_radio","Must choose a Role");
				</script>
			<?php endif; ?>
			<?php if($action== 'editform'):?>
				<script type="text/javascript">
					 var frmvalidator  = new Validator("?editform");
					frmvalidator.addValidation("userName","req","Must have a User Name");
					frmvalidator.addValidation("password","eqelmnt=passwordConfirm","Passwords Don't Match"); 
				</script>
			<?php endif; ?>
		</div>
	</body>
</html>
