<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
include_once $_SERVER['DOCUMENT_ROOT'] . '/libraries/mpdf/mpdf.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
$fromRetainedEarnings = TRUE;
include $_SERVER['DOCUMENT_ROOT'] . 'QuadFinancial/Reports/IncomeStatement/index.php';

	try {
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
		$sql = 'SELECT 
				Id,
				CONCAT(Code," ",Name) AS codeName 
			FROM Account
			WHERE Deleted = FALSE
			AND Name = "Retained Earnings"
			ORDER BY Code;
					';
		$priorResult = $pdo->prepare($sql);
		$priorResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching Retained Earnings.';
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
			AND Type = "DIVIDEND"
			ORDER BY Code;
					';
		$divResult = $pdo->prepare($sql2);
		$divResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching Dividends.';
		include '../error.html.php';
		exit();
	}
	foreach ($priorResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$retained[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$priorRetainedTotal = $priorRetainedTotal + $acctInfo[0]['value'];
		}else{
			$priorRetainedTotal = $priorRetainedTotal - $acctInfo[0]['value'];
		}
	}
	foreach ($divResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		$dividends[] = array(
						'codeName' => $row['codeName'],
						'value'=>$acctInfo[0]['value'],
						'normBal'=>$acctInfo[0]['normBal'],
						'creditOrDebit'=>$acctInfo[0]['creditOrDebit']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$dividendTotal = $dividendTotal + $acctInfo[0]['value'];
		}else{
			$dividendTotal = $dividendTotal - $acctInfo[0]['value'];
		}
	}
		$retainedAndIncome = $priorRetainedTotal + $netIncome;
		$newRetained = $retainedAndIncome -$dividendTotal;

if($fromBalanceSheet){return;}
if (isset($_POST['action'])){
$printReport=TRUE;
ob_start();
	include('retainedEarnings.html.php');
	$div = ob_get_contents();
ob_end_clean();
$mpdf = new mPDF('','',8,'','','','','','','','L');
//$mpdf->WriteHTML($stylesheet,1);
$mpdf->WriteHTML($div);
$mpdf->Output();
exit();
}
include 'retainedEarnings.html.php';
