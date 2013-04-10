<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php'; ?>



	<form action="" method="post" style="border:none;background-color:transparent">
		<div style="border:none;background-color:transparent">
			<input type="hidden" name="action" value="logout">
			<input type="hidden" name="goto" value="/QuadFinancial/">
			<input type="submit" value="Log out">
		</div>
	</form>
	<form action="/QuadFinancial/index.php" method="post" style="border:none;background-color:transparent">
		<div style="border:none;background-color:transparent">
			<input type="hidden" name="action" value="userChangePassword">
			<input type="submit" value="Change Password">
		</div>
	</form>

