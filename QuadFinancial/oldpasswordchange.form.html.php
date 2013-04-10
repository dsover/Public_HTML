<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'].'/includes/access.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset="utf-8">
		<title>You Need a new password</title>
		<script src="/javascript/javascript_form/gen_validatorv4.js" type="text/javascript"></script>
	</head>
	<body>
		<?php include './flyout.html.php'?>
		<div id="entryform2">
			<h1>Time to change your Password!</h1>
				<?php if (isset($passChangeError)):?>
					<p><?php htmlout($passChangeError);?></p>
				<?php endif; ?>
			<table>
				<form action="" id="changePassword" method="post">
						<tr>
							<th><label for="newpassword">Please enter a new password here: </label></td>
							<td><input type="password" name="newpassword" id="newpassword" placeholder="new password"></td>
						</tr>
						<tr>
							<th><label for="passwordConfirm">Confirm password: </label></th>
							<td><input type="password" name="passwordConfirm" id="passwordConfirm" placeholder="confirm password"></td>
						</tr>
						<tr>
							<td><input type="hidden" name="action" value="changePassword"><input type="submit" value="Change Password"></td>
						</tr>
				</form>
					<script type="text/javascript">
						 var frmvalidator  = new Validator("changePassword");
						frmvalidator.addValidation("newpassword","req","Password Required");
						frmvalidator.addValidation("newpassword","minlength=8","Password Must be at least 8 digits");
						frmvalidator.addValidation("newpassword","eqelmnt=passwordConfirm","Passwords Don't Match"); 
					</script>
				<form action="" method="post">
						<tr>
							<input type="hidden" name="action" value="logout">
							<input type="hidden" name="goto" value="/QuadFinancial/">
							<td><input type="submit" value="Log out"></td>
						</tr>
				</form>
			</table>
		</div>
	</body>
</html>
