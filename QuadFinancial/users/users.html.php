<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<meta charset="utf-8">
		<title>Manage Users</title>
	</head>
	<body>
		<?php  include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="user">
			<table>
				<?php if(!empty($Users)): ?>
							<tr>
								<td style="background-color:lightgrey;text-align:left;padding-left:1em">#</td>
								<td style="background-color:lightgrey;text-align:left;padding-left:1em">Name</td>
								<td style="background-color:lightgrey;text-align:left;padding-left:1em">User Type</td>
								<?php if(!$deletedForm): ?><td style="background-color:lightgrey;border:none;text-align:left;border:none;padding-left:1em">Actions</td><?php endif; ?>
								<?php if(!$deletedForm): ?><td style="background-color:lightgrey;border:none;text-align:left;border:none;padding-left:1em"></td><?php endif; ?>
								<?php if($deletedForm): ?><td style="background-color:lightgrey;border:none;text-align:left;border:none;padding-left:1em">Actions</td><?php endif ?>
							</tr>
				<?php foreach ($Users as $User): ?>
					<form action="?" method="post">
							<tr>
								<td style="border:none;text-align:left;border:none;padding-left:1em"><?php htmlout($User['id']); ?>. </td>
								<td style="border:none;text-align:left;border:none;padding-left:1em"><?php htmlout($User['name']); ?></td>
								<td style="border:none;text-align:left;border:none;padding-left:1em"><?php htmlout($User['userType']); ?></td>
								<input type="hidden" name="id" value="<?php echo $User['id']; ?>">
								<?php if(!$deletedForm): ?><td style="border:none;text-align:left;border:none;padding-left:1em"><input type="submit" name="action" value="Edit"></td><?php endif; ?>
								<?php if(!$deletedForm): ?><td style="border:none;text-align:left;border:none;padding-left:1em"><input type="submit" name="action" value="Inactivate"></td><?php endif; ?>
								<?php if($deletedForm): ?><td style="border:none;text-align:left;border:none;padding-left:1em"><input type="submit" name="action" value="Activate"></td><?php endif; ?>
							</tr>
					</form>
				<?php endforeach; else:?><p>No inactive users found</p> <?php endif;?>
			</table>
		</div>
	</body>
</html>
