<?php include_once $_SERVER['DOCUMENT_ROOT'] .
    '/includes/helpers.inc.php'; 
	If ($_SESSION['lock']){echo("<h1 style='color:red'>");htmlout("You have Exceded 3 Failed Login Attempts!! Please contact the adminstrator");echo("</h1>"); exit();}?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset="utf-8">
		<title>Log In</title>
	</head>
	<body>
			<h1>LogIn</h1>
		<div id="entryform3">
			<?php if (isset($loginError)):?>
				<p><?php htmlout($loginError);?></p>
			<?php endif; ?>
			<form action="" method="post">
			<table style="border:none">
				<tr>
					<td style="border:none"><label for="userName">User Name:</td>
					<td style="border:none"> <input type="text" name="userName" id="userName" placeholder="username"></td></label>
				</tr>
				<tr>
					<td style="border:none"><label for="password">Password:</td>
					<td style="border:none"> <input type="password" name="password" id="password" placeholder="password"></td></label>
				</tr>
				<tr>
					<td style="border:none"><input type="hidden" name="action" value="login">
					<input type="submit" value="Log in"></td>
				</tr>
			</form>
			<p>Welcome to QuadFinancial</p>
		</div>
	</body>
</html>
