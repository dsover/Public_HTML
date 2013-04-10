<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

if (!userIsLoggedIn()){
	include '../login.html.php';
	exit();
}
if (!userHasRole(1)){
	$error = 'Only Administrators may access this page.';
	include '../accessdenied.html.php';
	exit();
}


if (isset($_GET['add'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
	$pageTitle = 'New User';
	$action = 'addform';
	$userName = '';
	$id = '1';
	$resetFlag ='1';
	$button = 'Add User';

	//Build the list of roles
	try {
		$result = $pdo->query('SELECT Id, Name FROM UserType order by Id');	
	}catch (PDOException $e){
		$error = 'Error fetching list of roles.';
		include 'error.html.php';
		exit();	
	}

	foreach ($result as $row){
		$roles[] = array(
						'id' => $row['Id'],
						'name' => $row['Name'],
						'selected' => FALSE);	
	}

	include 'form.html.php';
	exit();
}

if (isset($_GET['addform'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try{

		if($_POST['password'] != '') {
			$pass = md5($_POST['password'] . '!trueSeed');
		}
		$sql = 'INSERT INTO User SET
			UserName = :name,
			Password = :password,
			ResetNextLogin = :resetFlag,
			UserTypeId = :Role';
		$s = $pdo->prepare($sql);
		$s->bindValue(':name', $_POST['userName']);
		$s->bindValue(':password', $pass);
		$s->bindValue(':resetFlag',$_POST['resetFlag']);
		$s->bindValue(':Role',$_POST['role']);
		$s->execute();
	} catch (PDOException $e) {
		$error ='Error adding submitted User.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}
if (isset($_GET['inactiveUsers'])){
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$result = $pdo->query('SELECT Id, UserName FROM User WHERE Deleted = TRUE');
	} catch (PDOException $e) {
		$error = 'Error fetching Users from the database!';
		include 'error.html.php';
		exit();
	}
	$deletedForm = True;
	foreach ($result as $row){
		$Users[] = array('id' => $row['Id'], 'name' => $row['UserName']);
	}

	include 'users.html.php';
	exit();
}



if (isset($_POST['action']) and $_POST['action'] == 'Edit'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
		$sql = 'SELECT Id, UserName,ResetNextLogin,UserTypeId FROM User WHERE Id = :id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching User details.';
		include 'error.html.php';
		exit();
	}

	$row = $s->fetch();
		$pageTitle = 'Edit User';
		$action = 'editform';
		$userName = $row['UserName'];
		$password= '';
		$resetFlag= $row['ResetNextLogin'];
		$id = $row['Id'];
		$button = 'Update User';
	//Build the list of roles
	try {
		$result = $pdo->query('SELECT Id, Name FROM UserType order by Id');	
	}catch (PDOException $e){
		$error = 'Error fetching list of roles.';
		include 'error.html.php';
		exit();	
	}
	foreach ($result as $row2){
		$roles[] = array(
						'id' => $row2['Id'],
						'name' => $row2['Name'],
						'selected' => $row['UserTypeId']);	
	}
	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

	try {
	$sql = 'UPDATE User SET
			UserName = :name,
			ResetNextLogin = :resetFlag,
			UserTypeId = :role
		WHERE Id = :id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':name', $_POST['userName']);
	$s->bindValue(':resetFlag',$_POST['resetFlag']);
	$s->bindValue(':role',$_POST['role']);
	$s->bindValue(':id',$_POST['id']);
	$s->execute();
	} catch (PDOException $e) {
		$error = $e;// 'Error updating submitted user.';
		include 'error.html.php';
		exit();
	}

	if ($_POST['password'] != ''){
		$pass = md5($_POST['password'] . '!trueSeed');
		try {
			$sql = 'UPDATE User SET
					Password = :password
					WHERE Id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':password',$pass);
			$s->bindValue(':id',$_POST['id']);
			$s->execute();
		}catch (PDOExeption $e){
		$error = 'error setting User password.';  		
			include 'error.html.php';
		exit();
		}	
	}
	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Inactivate'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//Inactivate User
	try{
			$sql = 'UPDATE User SET Deleted = TRUE WHERE Id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id',$_POST['id']);
			$s->execute();
		}catch (PDOExeption $e){
			$error = 'error Inactivating user.';  		
			include 'error.html.php';
			exit();
		}	

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Activate'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

//Activate User
	try{
			$sql = 'UPDATE User SET Deleted = FALSE WHERE Id = :id';
			$s = $pdo->prepare($sql);
			$s->bindValue(':id',$_POST['id']);
			$s->execute();
		}catch (PDOExeption $e){
			$error = 'error Activating user.';  		
			include 'error.html.php';
			exit();
		}	

	header('Location: .');
	exit();
}


// Display User list
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try{
	$result = $pdo->query('SELECT u.Id, 
							u.UserName, 
							ut.Name
						 FROM User u 
							JOIN UserType ut on ut.Id = u.UserTypeId
						 WHERE u.Deleted = FALSE');
} catch (PDOException $e) {
	$error = $e.'Error fetching Users from the database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row){
	$Users[] = array('id' => $row['Id'], 
					'name' => $row['UserName'],
					'userType' => $row['Name']);
}

include 'users.html.php';
