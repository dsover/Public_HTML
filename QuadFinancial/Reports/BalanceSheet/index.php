<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

$fromBalanceSheet = TRUE;
$firstAsset = TRUE;
$firstLiab = TRUE;
$firstShe = TRUE;
include $_SERVER['DOCUMENT_ROOT'] . 'QuadFinancial/Reports/RetainedEarnings/index.php';
	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = 'SELECT 
				Id,
				CONCAT(Code," ",Name) AS codeName 
			FROM Account
			WHERE Deleted = FALSE
			AND Type = "ASSET"
			ORDER BY Code;
					';
		$assetResult = $pdo->prepare($sql);
		$assetResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching Asset accounts.';
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
			AND Type = "LIABILITY"
			ORDER BY Code;
					';
		$lilResult = $pdo->prepare($sql2);
		$lilResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching Liabilities accounts.';
		include '../error.html.php';
		exit();
	}
	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql3 = 'SELECT 
				Id,
				CONCAT(Code," ",Name) AS codeName 
			FROM Account
			WHERE Deleted = FALSE
			AND Type = "SHE"
			ORDER BY Code;
					';
		$sheResult = $pdo->prepare($sql3);
		$sheResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching Stockholder accounts.';
		include '../error.html.php';
		exit();
	}
	foreach ($assetResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$assets[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$assetsTotal = $assetsTotal + $acctInfo[0]['value'];
		}else{
			$assetsTotal = $assetsTotal - $acctInfo[0]['value'];
		}
	}
	foreach ($lilResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$liabilities[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$liabTotal = $liabTotal + $acctInfo[0]['value'];
		}else{
			$liabTotal = $liabTotal - $acctInfo[0]['value'];
		}
	}
	foreach ($sheResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$shes[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$sheTotal = $sheTotal + $acctInfo[0]['value'];
		}else{
			$sheTotal = $sheTotal - $acctInfo[0]['value'];
		}
	}
		$sheTotal = $sheTotal +$newRetained;
		$sheAndLiabTotal = $sheTotal + $liabTotal;
	if ($fromRatio == TRUE){return;}


if (isset($_POST['action'])){
	$printReport=TRUE;
	ob_start();
		include('balanceSheet.html.php');
		$div = ob_get_contents();
	ob_end_clean();
	$mpdf = new mPDF('','',8,'','','','','','','','L');
	$mpdf->WriteHTML($div);
	$mpdf->Output();
	exit();
}
include 'balanceSheet.html.php';
