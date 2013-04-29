<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
//	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
//if (!userHasRole(1) ){
//	$error = 'Only Site Administrators may access this page.';
//	include $_SERVER['DOCUMENT_ROOT'] . '/QuadFinancial/accessdenied.html.php';
//	exit();
//}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<title><?php htmlout($header); ?> Journal Entries</title>
	</head>
	<body>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; ?>
		<?php include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/journal/flyout.html.php' ?>
		<form name="sort" action="?<?php htmlout('sort'.$header);?>" id="printButton" method="post" >
			<select name="sort" onchange="this.form.submit()">
				<option value=''>Sort by</option>
				<option value=" Order by thisJournalId desc">Journal Id Decending</option>
				<option value=" Order by thisJournalId asc">Journal Id Assending</option>
				<option value=" Order by userName desc">User Descending</option>
				<option value=" Order by userName asc">User Asscending</option>
				<option value=" Order by Date desc">Date Descending</option>
				<option value=" Order by Date asc">Date Asscending</option>
			</select>
		</form>
			<?php foreach($Entries as $entry => $k):?>
		<div id="journalView" >
			<?php if ($review and !$Entries[0][0]):  ?>
				<h1>There are no <?php htmlout($header); ?> Journals</h1>
			<?php exit(); ?>
			<?php endif;?>
					<h1><?php htmlout($header. ' Entry--' . 'Journal Id # ' . ($k[0])); ?></h1>
					<?php
							$journalId= $k[0];
							$date = $k[1];
							$description= $k[2];
							$lineItem = $k[3];
							$user = $k[4];
							$admin = $k[6];
							$fileName = $k[5];
							$changeDate = $k[7];
							$_SESSION['$journalLineItems'] = count($k[3]);
							include 'form.html.php'; 
					?>
		</div>
	<hr>
			<?php endforeach; ?>
	</body>
</html>
