<?php 
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
		global $lineError;

if (!userIsLoggedIn()){
	include '../login.html.php';
	exit();
}

$thisJournalId = '';//$_POST['thisJournalId'];
$date = '';
$description = '';
$accountLineId = '';
$accounts = '';
$debits = '';
$currency = '';
$file = '';

if (isset($_POST['action']) and ($_POST['action'] == 'Submit' or$_POST['action'] == 'addLine') ){
	$date = $_POST['journalEntryDate'];
	$description = $_POST['description'];
	$accountLineId = $_POST['lineIds'];
	$accounts = $_POST['account'];
	$debits = $_POST['debit'];
	$currency = $_POST['currency'];
	$errorFlag = false;
	$fileName = $_FILES['file']['name'];
	$tmpName  = $_FILES['file']['tmp_name'];
	$fileSize = $_FILES['file']['size'];
	$fileType = $_FILES['file']['type'];
	

	if($fileName != '' or $fileName != null){
		$fp = fopen($tmpName, 'r');
		$content = fread($fp, filesize($tmpName));
		fclose($fp);
	}
if($_POST['action'] == 'addLine'){
	$errorFlag = true;
	$_SESSION['$journalLineItems'] = $_SESSION['$journalLineItems'] +1;
}
	////check line input if any line field is selected all items must be present
	foreach ($_POST['lineIds'] as $k){
		if($accounts[$k] != ""){
			if($debits[$k] == 'none'){
				$errorMessage="Select debit/credit!!";
			}elseif($currency[$k] == ''){
				$errorMessage="Missing amount!!";
			}
		}elseif($debits[$k] != 'none'){
			if($currency[$k] == ''){
				$errorMessage="Missing amount!!";
			}elseif($accounts[$k] == ""){
				$errorMessage="Missing account!!";
			}
		}elseif($currency[$k] != ''){
			if($debits[$k] == 'none'){
				$errorMessage="Select debit/credit!!";
			}elseif($accounts[$k] != ""){
				$errorMessage="Missing account!!";
			}
		}else{
			$errorMessage='';
		}
		if ($errorMessage != ''){
			$errorFlag = true;
		}$lineError[]= array("text" =>$errorMessage);

		//create an array to represent each line
		$lineItem[] = array(
					'lineId' => $k,
					'accountId' => $accounts[$k],
					'debitOrCredit' => $debits[$k],
					'currency' => $currency[$k],
					'user' => $_SESSION['userName']
		);
	}
	if ($errorFlag){
		$accounts = getAccounts();
		include 'form.html.php';
		return  FALSE;
	}
	//aggrigate credits and debits of each line item
	foreach($lineItem as $key=> $l){
		if ($lineItem[$key]['debitOrCredit'] == 'debit'){
			$numOfDebits += '1';
			$sumdebits += $lineItem[$key]['currency'];
		}else if($lineItem[$key]['debitOrCredit'] == 'credit'){
			$numOfCredits += 1;
			$sumcredits += $lineItem[$key]['currency'];
		}
	}
	//check to see that there are a min of 1 credit and 1 debit and if debits equal credits
	if ($numOfCredits <1 or $numOfDebits <1){
		$accounts = getAccounts();
		$GLOBALS['creditError'] ='Must have at least 1 credit and one debit';
		include 'form.html.php';
		return  FALSE;
	}else if ($sumcredits != $sumdebits){
		$accounts = getAccounts();
		$GLOBALS['creditError'] ='Debit/Credit must be equal';
		include 'form.html.php';
		return  FALSE;
	}else{ $GLOBALS{'creditError'} = '';}
//echo var_dump($lineItem);exit();
	try{
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		//$pdo->beginTransaction();
		$sql = "Insert Into JournalEntry set
				Description = :description,
				CreatedOn = NOW(),
				PostedOn = '0000-00-00 00:00:00',
				Date = :date,
				Posted = 0,
				PosterUserId = :UserId,
				SupportingDocument = :content,
				SupportingDocumentName = :fileName,
				SupportingDocumentType = :fileType,
				SupportingDocumentSize = :fileSize;";
		$s=$pdo->prepare($sql);
		$s->bindValue(':description',$description);
		$s->bindValue(':date',$date);
		$s->bindValue(':UserId', $_SESSION['userId']);
		$s->bindValue(':content',$content);
		$s->bindValue(':fileName',$fileName);
		$s->bindValue(':fileType',$fileType);
		$s->bindValue(':fileSize',$fileSize);
		$s->execute();
// add PDO::lastInsertid instead of (SELECT MAX(Id) FROM JournalEntry),
		foreach($lineItem as $key=> $l){
			if($lineItem[$key]['accountId']){
				$sql2 = "INSERT INTO DataPoints set
						JournalEntryId = (SELECT MAX(Id) FROM JournalEntry),
						AccountId = :accounts,
						DebitOrCredit = :debits,
						Amount = :currency;";
			$s2=$pdo->prepare($sql2);
			$s2->bindValue(':accounts',$lineItem[$key]['accountId']);
			$s2->bindValue(':debits',$lineItem[$key]['debitOrCredit']);
			$s2->bindValue(':currency',$lineItem[$key]['currency']);
			$s2->execute();
			}
		}
		//$pdo->commit();
	} catch (PDOException $e){
		$error = $e;//'Error adding journal.';
		include 'error.html.php';
		exit();
	}
	header ('Location: index.php');
}
//-----------------------------------------------show pending entries
$_SESSION['$journalLineItems'] =2;
if(isset($_GET['pendingJournals'])){
	$accounts = getAccounts();
	$review = 1; 
	$header = 'Pending'; 
	$Entries = getPendingEntries();
	include 'journals.html.php';
	exit();
}
if(isset($_GET['deletedJournals'])){
	$accounts = getAccounts();
	$review = 1; 
	$header = 'Deleted'; 
	$Entries = getDeletedEntries();
	include 'journals.html.php';
	exit();
}
if(isset($_GET['postedJournals'])){
	$accounts = getAccounts();
	$review = 1; 
	$header = 'posted'; 
	$Entries = getPostedEntries();
	include 'journals.html.php';
	exit();
}
if(isset($_GET['getFile'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'SELECT SupportingDocument
					,SupportingDocumentName
					,SupportingDocumentType
					,SupportingDocumentSize
			FROM JournalEntry 
			WHERE Id = :journalId;';
		$s=$pdo->prepare($sql);
		$s->bindValue(':journalId', $_GET['getFile']);
		$s->execute();
	} catch (PDOException $e){
		$error = 'Error retriving file.' . $e;
		include 'error.html.php';
		exit();
	}

	foreach ($s as $row){
header("Content-length:".$row['SupportingDocumentSize']);
header("Content-type:".$row['SupportingDocumentType']);
header("Content-Disposition: attachment; filename=".$row['SupportingDocumentName']);
	}
echo $row['SupportingDocument'];
exit();
}

if (isset($_POST['postEntry'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'UPDATE JournalEntry SET 
							Posted = TRUE,
							AuthorizerUserId = :UserId,
							PostedOn = NOW()
			WHERE Id = :journalId;';
		$s=$pdo->prepare($sql);
		$s->bindValue(':journalId', $_POST['journalId']);
		$s->bindValue(':UserId', $_SESSION['userId']);
		$s->execute();
	} catch (PDOException $e){
		$error = 'Error Posting journal.' . $e;
		include 'error.html.php';
		exit();
	}
	header ('Location: ?pendingJournals');
	exit();
}
if (isset($_POST['deleteEntry'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'UPDATE JournalEntry SET 
							Deleted = TRUE
			WHERE Id = :journalId;';
		$s=$pdo->prepare($sql);
		$s->bindValue(':journalId', $_POST['journalId']);
		$s->execute();
	} catch (PDOException $e){
		$error = 'Error Deleting journal.' . $e;
		include 'error.html.php';
		exit();
	}
	header ('Location: ?pendingJournals');
	exit();
}
if (isset($_POST['unDeleteEntry'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'UPDATE JournalEntry SET 
							Deleted = FALSE
			WHERE Id = :journalId;';
		$s=$pdo->prepare($sql);
		$s->bindValue(':journalId', $_POST['journalId']);
		$s->execute();
	} catch (PDOException $e){
		$error = 'Error Un-deleting journal.' . $e;
		include 'error.html.php';
		exit();
	}
	header ('Location: ?pendingJournals');
	exit();
}



$accounts = getAccounts();
include 'form.html.php';



function getAccounts (){

	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
		$accountsSql = 'select c.Name as "CategoryName"
					,a.Id as "AccountId"
					,a.Code as "AccountCode"
					,a.Name as "AccountName"
				From Account a 
				join Category c on c.Id = a.CategoryId
				WHERE a.Deleted = FALSE
				ORDER BY c.Id, a.Code';
		$accountResult = $pdo->query($accountsSql);
	}catch (PDOException $e){
		$error = 'Error fetching accounts: ' . $e->getMessage();
		include 'error.html.php'; 
		exit(); 
	}

	foreach ($accountResult as $row){
		$accountList[] = array('id'=> '1',
						'categoryName' => $row['CategoryName'],
						'accountId' => $row['AccountId'],
						'accountCode' => $row['AccountCode'],
						'accountName' => $row['AccountName']);
		}
return $accountList;
}

function getPendingEntries(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$pendingSql = 'SELECT 	je.Id as "thisJournalId"
							,date(je.Date) as "date"
							,je.Description as "description"
							,a.Id as "accountId"
							,a.Name as "accountName"
							,dp.DebitOrCredit as "debitOrCredit"
							,dp.Amount as "currency"
							,u.UserName as "userName"
							,je.SupportingDocumentName as "thisFileName"
						FROM 
							JournalEntry je
							join DataPoints dp on dp.JournalEntryId = je.Id
							join Account a on a.Id = dp.AccountId
							join User u on je.PosterUserId = u.Id
						WHERE
							Posted = FALSE AND je.Deleted != TRUE
						ORDER BY
							thisJournalId,debitOrCredit desc, accountId;';
		$journals = $pdo->query($pendingSql);
		$journals->setFetchMode(PDO::FETCH_ASSOC);
	}catch (PDOException $e){
	$error = 'Error fetching Pending Journal Entries: ' . $e->getMessage();
	include 'error.html.php'; 
	exit(); 
	}
	$first= TRUE;
	foreach($journals as $k => $row){ 
		If($first){
			$journalIdFlag =$row['thisJournalId'];
			$first=FALSE;
		}
		if(($journalIdFlag) == ($row['thisJournalId'])){
			$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency']
						);
		}else{		
					$pendingEntries[] = array($JournalId =$thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
					$lineItems = array();
					$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency']
						);
		}
		$thisUserId = $row['userName'];
		$thisJournalId = $row['thisJournalId'];
		$thisDate = $row['date'];
		$thisDescription = $row['description'];
		$journalIdFlag =$row['thisJournalId'];
		$thisFileName = $row['thisFileName'];
	} 
	$lastEntry[] = array(	$JournalId = $thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
	if($pendingEntries){
		$pendingEntries = array_merge($pendingEntries,$lastEntry);
	}else{
		$pendingEntries = $lastEntry;
	}
	return $pendingEntries;
}


function getDeletedEntries(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$deletedSql = 'SELECT 	je.Id as "thisJournalId"
							,date(je.Date) as "date"
							,je.Description as "description"
							,a.Id as "accountId"
							,a.Name as "accountName"
							,dp.DebitOrCredit as "debitOrCredit"
							,dp.Amount as "currency"
							,u.UserName as "userName"
							,je.SupportingDocumentName as "thisFileName"
						FROM 
							JournalEntry je
							join DataPoints dp on dp.JournalEntryId = je.Id
							join Account a on a.Id = dp.AccountId
							join User u on je.PosterUserId = u.Id
						WHERE
							 je.Deleted = TRUE
						ORDER BY
							thisJournalId,debitOrCredit desc, accountId;';
		$journals = $pdo->query($deletedSql);
		$journals->setFetchMode(PDO::FETCH_ASSOC);
	}catch (PDOException $e){
	$error = 'Error fetching Deleted Journal Entries: ' . $e->getMessage();
	include 'error.html.php'; 
	exit(); 
	}
	$first= TRUE;
	foreach($journals as $k => $row){ 
		If($first){
			$journalIdFlag =$row['thisJournalId'];
			$first=FALSE;
		}
		if(($journalIdFlag) == ($row['thisJournalId'])){
			$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency'],
							'user' => $row['userName']
						);
		}else{		
					$deletedEntries[] = array($JournalId =$thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
					$lineItems = array();
					$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency'],
							'user' => $row['userName']
						);
		}
		$thisUserId = $row['userName'];
		$thisJournalId = $row['thisJournalId'];
		$thisDate = $row['date'];
		$thisDescription = $row['description'];
		$journalIdFlag =$row['thisJournalId'];
		$thisFileName = $row['thisFileName'];
	} 
	$lastEntry[] = array(	$JournalId = $thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
	if($deletedEntries){
		$deletedEntries = array_merge($deletedEntries,$lastEntry);
	}else{
		$deletedEntries = $lastEntry;
	}
	return $deletedEntries;
}


function getPostedEntries(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$postedSql = 'SELECT 	je.Id as "thisJournalId"
							,date(je.Date) as "date"
							,je.Description as "description"
							,a.Id as "accountId"
							,a.Name as "accountName"
							,dp.DebitOrCredit as "debitOrCredit"
							,dp.Amount as "currency"
							,u.UserName as "userName"
							,je.SupportingDocumentName as "thisFileName"
						FROM 
							JournalEntry je
							join DataPoints dp on dp.JournalEntryId = je.Id
							join Account a on a.Id = dp.AccountId
							join User u on je.AuthorizerUserId = u.Id
						WHERE
							 je.Posted = TRUE
						ORDER BY
							thisJournalId,debitOrCredit desc, accountId;';
		$journals = $pdo->query($postedSql);
		$journals->setFetchMode(PDO::FETCH_ASSOC);
	}catch (PDOException $e){
	$error = 'Error fetching Posted Journal Entries: ' . $e->getMessage();
	include 'error.html.php'; 
	exit(); 
	}
	$first= TRUE;
	foreach($journals as $k => $row){ 
		If($first){
			$journalIdFlag =$row['thisJournalId'];
			$first=FALSE;
		}
		if(($journalIdFlag) == ($row['thisJournalId'])){
			$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency'],
							'user' => $row['userName']
						);
		}else{		
					$postedEntries[] = array($JournalId =$thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
					$lineItems = array();
					$lineItems[] =	array('lineId' => $k,
							'accountId' => $row['accountId'],
							'accountName' => $row['accountName'],
							'debitOrCredit' => $row['debitOrCredit'],
							'currency' => $row['currency'],
							'user' => $row['userName']
						);
		}
		$thisUserId = $row['userName'];
		$thisJournalId = $row['thisJournalId'];
		$thisDate = $row['date'];
		$thisDescription = $row['description'];
		$journalIdFlag =$row['thisJournalId'];
		$thisFileName = $row['thisFileName'];
	} 
	$lastEntry[] = array(	$JournalId = $thisJournalId,
						$date = $thisDate ,
						$description = $thisDescription,
						$lineItems,
						$thisUserId,
						$thisFileName);
	if($postedEntries){
		$postedEntries = array_merge($postedEntries,$lastEntry);
	}else{
		$postedEntries = $lastEntry;
	}
	return $postedEntries;
}
