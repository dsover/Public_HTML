<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
if (!userIsLoggedIn()){
	include '../login.html.php';
	exit();
}

if (!userHasRole(1) ){
	$error = 'Only Site Administrators may access this page.';
	include $_SERVER['DOCUMENT_ROOT'] . '/QuadFinancial/accessdenied.html.php';
	exit();
}

if (isset($_GET['add'])){
	$pageTitle = 'Add New Account';
	$action = 'addform';
	$accountName = '';
	$accountCode = '';
	$accountBeginingBalance = '';
	$description = '';
	$authorid = '';
	$categoryId = '';
	$type = '';
	$normalBalance = '';
	$isInventory = null;
	$id = '';
	$button = 'Add account';


	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// Build the list of categories
	try{
		$result = $pdo->query('SELECT Id, Name FROM Category WHERE Deleted = FALSE');
	}catch (PDOException $e){
		$error = 'Error fetching list of categories.';
		include 'error.html.php';
		exit();
	}

	foreach ($result as $row){
		$categories[] = array(
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
	$sql = 'Insert Into Account set
						Name = :Name,
						InitialBalance = 0,
						Code = :Code,
						CategoryId = :CategoryId,
						UserId = :UserId,
						Description = :Description,
						Type = :type,
						NormalBalance = :normalBalance,
						isInventory = :isInventory;';
	$s = $pdo->prepare($sql);
	$s->bindValue(':Name', $_POST['accountName']);
	$s->bindValue(':Code', $_POST['accountCode']);
	$s->bindValue(':CategoryId', $_POST['categoryId']);
	$s->bindValue(':UserId', $_SESSION['userId']);
	$s->bindValue(':Description', $_POST['description']);
	$s->bindValue(':type',$_POST['type']);
	$s->bindValue(':normalBalance',$_POST['normalBalance']);
	$s->bindValue(':isInventory',$_POST['isInventory']);
	$s->execute();
	} catch (PDOException $e){
		$error = $e.'Error adding account.';
		include 'error.html.php';
		exit();
	}

	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Edit'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'SELECT Id,
					 Name,
					Code,
					InitialBalance,
					Description,
					CategoryId,
					UserId,
					Type,
					NormalBalance,
					isInventory
			 FROM Account WHERE Id = :id and Deleted = FALSE';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['accountId']);
		$s->execute();
	}catch (PDOException $e){
		$error = 'Error fetching joke details.';
		include 'error.html.php';
		exit();
	}
	$row = $s->fetch();
	$pageTitle = 'Edit Account';
	$action = 'editform';
	$accountName = $row['Name'];
	$accountCode = $row['Code'];
	$accountBeginingBalance = $row['InitialBalance'];
	$description = $row['Description'];
	$authorid = $row['UserId'];
	$categoryId = $row['CategoryId'];
	$type = $row['Type'];
	$normalBalance = $row['NormalBalance'];
	$id = $row['Id'];
	$isInventory = $row['isInventory'];
	$button = 'Edit account';

	  // Build the list of all categories
	try{
		$result = $pdo->query('SELECT Id, Name FROM Category WHERE Deleted = FALSE ORDER BY id');
	}catch (PDOException $e){
		$error = 'Error fetching list of categories.';
		include 'error.html.php';
		exit();
	}
	foreach ($result as $row){
		$categories[] = array(
		'id' => $row['Id'],
		'name' => $row['Name']);
	}
	include 'form.html.php';
	exit();
}

if (isset($_GET['editform'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	if ($_POST['accountName'] == ''){
		$error = 'You must have an account name.Click &lsquo;back&rsquo; and try again.';
		include 'error.html.php';
		exit();
	}
	try{
		$sql = 'UPDATE Account SET
				Name = :Name,
				InitialBalance = 0,
				Code = :Code,
				CategoryId = :CategoryId,
				AlteredOn = NOW(),
				Description =:Description,
				Type = :type,
				NormalBalance = :normalBalance,
				isInventory = :isInventory
			WHERE Id = :Id';
	$s = $pdo->prepare($sql);
	$s->bindValue(':Name', $_POST['accountName']);
	$s->bindValue(':Code', $_POST['accountCode']);
	$s->bindValue(':CategoryId', $_POST['categoryId']);
	$s->bindValue(':Description', $_POST['description']);
	$s->bindValue(':Id',$_POST['id']);
	$s->bindValue(':type',$_POST['type']);
	$s->bindValue(':normalBalance',$_POST['normalBalance']);
	$s->bindValue(':isInventory',$_POST['isInventory']);
	$s->execute();
	}catch (PDOException $e){
		$error = $e;//'Error updating submitted account.';
		include 'error.html.php';
		exit();
	}


	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'Delete'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// Delete Accounts
	try{
		$sql = 'UPDATE Account SET Deleted = TRUE WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['accountId']);
		$s->execute();
	}catch (PDOException $e){
		$error = 'Error deleting Account.';
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

if (isset($_POST['action']) and $_POST['action'] == 'UnDelete'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// UnDelete Accounts
	try{
		$sql = 'UPDATE Account SET Deleted = FALSE WHERE Id = :Id';
		$s = $pdo->prepare($sql);
		$s->bindValue(':Id', $_POST['accountId']);
		$s->execute();
	}catch (PDOException $e){
		$error = 'Error UnDeleting Account.';
		include 'error.html.php';
		exit();
	}
	header('Location: .');
	exit();
}

if (isset($_GET['action']) and $_GET['action'] == 'search'){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// The basic SELECT statement
	$select = 'SELECT a.Id, 
				a.Name, 
				a.Code,
				a.Description,
				a.InitialBalance,
				c.Name as CatName,
				a.CreatedOn,
				a.AlteredOn,
				a.NormalBalance,
				a.isInventory,
				a.Type,
				u.UserName';
	$from   = ' FROM Account a JOIN Category c on c.Id = a.CategoryId JOIN User u on u.Id = a.UserId';
	$where  = ' WHERE TRUE';

	$placeholders = array();
	//name search
	if ($_GET['isDeleted'] == 'TRUE'){
		$deletedForm = TRUE;
		$where .= " AND a.Deleted = TRUE";
	}else{
		$deletedForm = FALSE;
		$where .= " AND a.Deleted = FALSE";
	}
	//name search
	if ($_GET['name'] != ''){
		$where .= " AND a.Name like :name";
	$placeholders[':name'] = '%' . $_GET['name'] . '%';
	}
	 // An user is selected
	if ($_GET['user'] != ''){
		$where .= " AND a.UserId = :userId";
	$placeholders[':userId'] = $_GET['user'];
	}

	 // A category is selected
	if ($_GET['category'] != ''){
		$where .= " AND a.CategoryId = :categoryId";
	$placeholders[':categoryId'] = $_GET['category'];
	}

	 // Some search text was specified
	if ($_GET['description'] != ''){
		$where .= " AND a.Description LIKE :description";
		$placeholders[':description'] = '%' . $_GET['description'] . '%';
	}
	try{
		$sql = $select . $from . $where;
		$s = $pdo->prepare($sql);
		$s->execute($placeholders);
	}
	catch (PDOException $e){
		$error = $e;//'Error fetching Accounts.';
		include 'error.html.php';
		exit();
	}

	foreach ($s as $row){
		$accounts[] = array('id' => $row['Id'],
						 'name' => $row['Name'],
						 'code' => $row['Code'],
						 'description' => $row['Description'],
						 'begBal' => $row['InitialBalance'],
						 'catName'=> $row['CatName'],
						 'createdOn'=> $row['CreatedOn'],
						 'type'=> $row['Type'],
						'isInventory'=>$row['isInventory'],
						 'normalBalance' => $row['NormalBalance'],
						 'createdBy'=> $row['UserName']
);
	}

	include 'accounts.html.php';
	exit();
}

// Display search form
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

try{
	$result = $pdo->query('SELECT Id, UserName FROM User WHERE Deleted = FALSE');
}catch (PDOException $e){
	$error = 'Error fetching users from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row){
	$users[] = array('id' => $row['Id'], 'name' => $row['UserName']);
}

try{
	$result = $pdo->query('SELECT Id, Name FROM Category WHERE Deleted = FALSE');
}catch (PDOException $e){
	$error = 'Error fetching categories from database!';
	include 'error.html.php';
	exit();
}

foreach ($result as $row){
	$categories[] = array('id' => $row['Id'], 'name' => $row['Name']);
}

include 'searchform.html.php';
