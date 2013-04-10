<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
include $_SERVER['DOCUMENT_ROOT'] . 'QuadFinancial/Reports/inc/helpers.inc.php';
//include '../inc/helpers.inc.php';
	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = 'SELECT 
				Id,
				CONCAT(Code," ",Name) AS codeName 
			FROM Account
			WHERE Deleted = FALSE
			AND Type = "REVENUE"
			ORDER BY Code;
					';
		$revResult = $pdo->prepare($sql);
		$revResult->execute();
	} catch (PDOException $e) {
		$error = 'Error revenue accounts.';
		include '../error.html.php';
		exit();
	}
	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql2 = 'SELECT 
				Id,
				CONCAT(Code," ",Name) AS codeName 
			FROM Account
			WHERE Deleted = FALSE
			AND Type = "EXPENSE"
			ORDER BY Code;
					';
		$expResult = $pdo->prepare($sql2);
		$expResult->execute();
	} catch (PDOException $e) {
		$error = 'Error expense accounts.';
		include '../error.html.php';
		exit();
	}
	foreach ($revResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$revenues[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$revTotal = $revTotal + $acctInfo[0]['value'];
		}else{
			$revTotal = $revTotal - $acctInfo[0]['value'];
		}
	}
	foreach ($expResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$expenses[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$expTotal = $expTotal + $acctInfo[0]['value'];
		}else{
			$expTotal = $expTotal - $acctInfo[0]['value'];
		}
	$netIncome = $revTotal - $expTotal;
	}
if($fromRetainedEarnings){return;}
include 'incomeStatement.html.php';
