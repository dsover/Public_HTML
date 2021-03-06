<?php 
	include $_SERVER['DOCUMENT_ROOT'] . 'includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
	include_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/mpdf/mpdf.php';
	if (!userIsLoggedIn()){
		include '../login.html.php';
		exit();
	}

if (isset($_POST['action']) and $_POST['action'] == 'View'){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$genAccountsSql = 
				'SELECT a.Name,
						a.Code,
						Date(a.CreatedOn) as "CreatedOn"
						,a.InitialBalance as "InitialBalance"
						,a.NormalBalance as "normBal"
						,a.Type as "AccountType",
						c.Name as "categoryName"
				FROM Account a 
				join Category c on a.CategoryId = c.Id
				WHERE a.Id = :acctId';
		$s=$pdo->prepare($genAccountsSql);
		$s->bindValue(':acctId',$_POST['acctId']);
		$s->execute();
		$accountJournals = 
				'Select 
					je.Id as "JournalId",
					DATE(je.Date) as "Date",
					je.Description as "Description",
					dp.DebitOrCredit as "DebitOrCredit",
					dp.Amount,
					je.SupportingDocument as "FileBianary",
					je.SupportingDocumentName as "FileName",
					je.SupportingDocumentType as "FileType",
					je.SupportingDocumentSize as "FileSize"
				from 
					JournalEntry je
					join 
						DataPoints dp on dp.JournalEntryId = je.Id
				where 
					AccountId = :acctId
				and 
					Posted = TRUE
				order By 
					je.Date;';
		$s2=$pdo->prepare($accountJournals);
		$s2->bindValue(':acctId',$_POST['acctId']);
		$s2->execute();
		$totals = 'select 
					sum(dp.Amount) as "sum"
				from 
					DataPoints dp
					join JournalEntry je on je.Id = dp.JournalEntryId
				where dp.DebitOrCredit = "debit" and dp.AccountId = :acctId AND je.Posted = TRUE
			union
				select 
					sum(dp.Amount) 
				from 
					DataPoints dp
					join JournalEntry je on je.Id = dp.JournalEntryId
				where dp.DebitOrCredit = "Credit" and dp.AccountId = :acctId AND je.Posted = TRUE;';
		$s3=$pdo->prepare($totals);
		$s3->bindValue(':acctId',$_POST['acctId']);
		$s3->execute();
	}catch (PDOException $e){
		$error = 'Error fetching account information: ' . $e->getMessage();
		include 'error.html.php'; 
		exit(); 
	}
		foreach ($s as $row){
			$InitialBalance = $row['InitialBalance'];
			$normBal= $row['normBal'];
			$accountType = $row['AccountType'];
			$CreatedOn = $row['CreatedOn'];
			$acctCode = $row['Code'];
			$name = $row['Name'];
			$categoryName = $row['categoryName'];
		}
		foreach ($s2 as $row2){
			$accountEntries[] =array('JournalId' => $row2['JournalId'],
								'date' => $row2['Date'],
								'description' => $row2['Description'],
								'debitOrCredit' => $row2['DebitOrCredit'],
								'amount' => $row2['Amount'],
								'FileBianary' => $row2['FileBianary'],
								'FileName' => $row2['FileName'],
								'FileType' => $row2['FileType'],
								'FileSize' => $row2['FileSize']);
		}

		$totalDebits = $s3->fetchColumn();
		$totalCredits = $s3->fetchColumn();
		if ($totalCredits > $totalDebits){
			$totalSum = $totalCredits - $totalDebits;
		}else{
			$totalSum = $totalDebits - $totalCredits;
		}		$totalSum = $totalSum + $InitialBalance;
	include 'accountJournal.html.php';
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
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	
		$accountsSql = 'select c.Name as "CategoryName"
					,a.Code as "AccountCode"
					,a.Name as "AccountName"
					,a.Id as "AccountId"
				From Account a 
				join Category c on c.Id = a.CategoryId
				WHERE a.Deleted = FALSE AND c.Deleted = FALSE
				ORDER BY c.Id, a.Code';
		$accountResult = $pdo->query($accountsSql);
	}catch (PDOException $e){
		$error = 'Error fetching accounts: ' . $e->getMessage();
		include 'error.html.php'; 
		exit(); 
	}

	foreach ($accountResult as $row){
		$accounts[] = array('id'=> '1','email' =>'2',
						'categoryName' => $row['CategoryName'],
						'accountCode' => $row['AccountCode'],
						'accountName' => $row['AccountName'],
						'accountId' => $row['AccountId']);
		}


if (isset($_POST['action'])){
$printReport=TRUE;
ob_start();
	include('chartOfAccounts.html.php');
	$div = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('','',8,'','','','','','','','L');
//$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($div);
$mpdf->Output();
exit();
}


include 'chartOfAccounts.html.php'; 
?>


