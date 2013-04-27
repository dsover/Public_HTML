<?php include_once $_SERVER['DOCUMENT_ROOT'] .
	'/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<link rel="stylesheet" type="text/css" href="/javascript/jquery.AddIncSearch-master/jquery.AddIncSearch.css">
		<meta charset="utf-8">
		<title>Manage Accounts</title>

	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="account">
			<form action="" method="get">
				<table>
					<tr>
						<th colspan="2"><p>View accounts satisfying the following criteria:</p></th>
					</tr>
					<tr>
							<th><label for="name">Search by name:</label></th>
							<td><input type="text" name="name" id="name" placeholder="name search"></td>
					</tr>
					<tr>
							<th><label for="description">Containing description:</label></th>
							<td><input type="text" name="description" id="description" placeholder="description search"></td>
					</tr>
					<tr>
						<th>
							<label for="user">By User:</label>
						</th>
						<td >
							<select name="user" id="user" >
								<option value="">Any User</option>
								<?php foreach ($users as $user): ?>
									<option value="<?php htmlout($user['id']); ?>"><?php htmlout($user['name']); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th>
							<label for="category">By Category:</label>
						</th>
						<td>
							<select name="category" id="category">
								<option value="">Any Category</option>
								<?php foreach ($categories as $category): ?>
									<option value="<?php htmlout($category['id']); ?>"><?php htmlout($category['name']); ?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					<tr>
						<th>Deleted:</th>
						<td>
							no<input type="radio" name="isDeleted" value="FALSE" id="FALSE" checked>
							yes<input type="radio" name="isDeleted" value="TRUE" id="TRUE">
						</td>
					</tr>
					<tr>
						<th colspan="2" align="left"><input type="hidden" name="action" value="search">
							<input type="submit" value="Search"></th>
					</tr>
				</table>
			</form>
		</div>
	</body>
</html>
