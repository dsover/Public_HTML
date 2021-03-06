<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';


if (!userIsLoggedIn()){
	include '../login.html.php';
	exit();
}
if (!userHasRole(1) ){
	$error = 'Only Site Administrators may access this page.';
	include '../accessdenied.html.php';
	exit();
}

if (isset($_GET['add'])){
	$pageTitle = 'New Category';
	$action = 'addform';
	$name = '';
	$description = '';
	$id = '';
	$button = 'Add category';

	include 'form.html.php';
	exit();
}
if (isset($_GET['showcategories'])){$deletedForm = FALSE;}
if (isset($_GET['showdeleted'])){
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
$deletedForm = TRUE;
	try{
		$result = $pdo->query('SELECT c.Id,
								c.Name, 
								c.Description,
								c.CreatedOn,
								c.AlteredOn,
								u.UserName
								 FROM Category c
									JOIN User u on u.Id = c.UserId
							WHERE c.Deleted = TRUE');
	} catch (PDOException $e) {
		$error = 'Error fetching categories from database!';
		include 'error.html.php';
		exit();
	}
	foreach ($result as $row){
		$categories[] = array('id' => $row['Id'], 
							'name' => $row['Name'],
							'description' =>$row['Description'],
							'createdOn' =>$row['CreatedOn'],
							'alteredOn' =>$row['AlteredOn'],
							'userName' =>$row['UserName']);
	}
	include 'categories.html.php';
	exit();
}

if (isset($_GET['addform'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try{
		$sql = 'INSERT INTO Category (Name,Description,UserId) Values
				(:Name,:Description,:UserId)';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Name', $_POST['name']);
		$s->bindValue(':Description', $_POST['description']);
		$s->bindValue(':UserId',$_SESSION['userId']);
		$s->execute();
	} catch (PDOException $e) {
		$error = 'Error adding submitted category.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try{
		$sql = 'SELECT Id, Name, Description FROM Category WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching category details.';
		include 'error.html.php';
		exit();
	}
	$row = $s->fetch();
	$pageTitle = 'Edit Category';
	$action = 'editform';
	$name = $row['Name'];
	$description = $row['Description'];
	$id = $row['Id'];
	$button = 'Update category';

	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'UPDATE Category set 
				Name =:Name,
				Description=:Description,
				AlteredOn =CURDATE()
			WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['id']);
		$s->bindValue(':Name', $_POST['name']);
		$s->bindValue(':Description',$_POST['description']);
		$s->execute();
	} catch (PDOException $e) {
		$error = 'Error updating submitted category.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}


if (isset($_POST['action']) and $_POST['action'] == 'UnDelete')
{	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// Delete the category
	try{
		$sql = 'UPDATE Category SET 
					Deleted = FALSE,
					AlteredOn =CURDATE()
			WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['id']);
		$s->execute();
	}catch (PDOException $e) {
		$error = 'Error Undeleting category.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}
if (isset($_POST['action']) and $_POST['action'] == 'Delete')
{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	//Check for associated accounts
	try {
		$sql = 'SELECT Id FROM Account WHERE CategoryId = :Id AND Deleted = FALSE';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['id']);
		$s->execute();
		$row = $s->fetch();
		if ($row){throw new Exception($error);}
	} catch (Exception $e) {
	$error = 'Error removing category. 
			This category has associated accounts.
			 Please change account details before deleting category';
	include 'error.html.php';
	exit();
	}

// Delete the category
	try{
		$sql = 'UPDATE Category SET 
					Deleted = TRUE,
					AlteredOn =CURDATE()
			WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['id']);
		$s->execute();
	}catch (PDOException $e) {
		$error = 'Error deleting category.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

// Display category list
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try{
	$result = $pdo->query('SELECT c.Id,
								c.Name, 
								c.Description,
								c.CreatedOn,
								c.AlteredOn,
								u.UserName
								 FROM Category c
									JOIN User u on u.Id = c.UserId
						WHERE c.Deleted != TRUE');
} catch (PDOException $e) {
	$error = 'Error fetching categories from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row){
	$categories[] = array('id' => $row['Id'], 
						'name' => $row['Name'],
						'description' =>$row['Description'],
						'createdOn' =>$row['CreatedOn'],
						'alteredOn' =>$row['AlteredOn'],
						'userName' =>$row['UserName']);
}

include 'categories.html.php';
