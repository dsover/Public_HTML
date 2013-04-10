<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

$firstCredit = TRUE;
$firstDebit = TRUE;

include '../inc/helpers.inc.php';
	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = 'SELECT 
				CONCAT(Code," ",Name) AS codeName ,
				Id
			FROM Account
			WHERE Deleted = FALSE
			ORDER BY Code;
					';
		$s = $pdo->prepare($sql);
		$s->bindValue(':id', $_POST['id']);
		$s->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching User details.';
		include '../error.html.php';
		exit();
	}
	foreach ($s as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$accounts[] = array(
						'codeName' => $row['codeName'],
						'creditOrDebit' => $acctInfo[0]['creditOrDebit'],
						'value'=> $acctInfo[0]['value']);
		if($acctInfo[0]['creditOrDebit'] == "CREDIT"){
			$totalCredits = $totalCredits + $acctInfo[0]['value'];
		}else{
			$totalDebits = $totalCredits + $acctInfo[0]['value'];
		}
	}


include 'trialBalance.html.php';


