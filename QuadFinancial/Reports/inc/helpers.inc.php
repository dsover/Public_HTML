<?php


function getAccountInfo($acctId){

	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$balSql = '
			SELECT 
				"1",
				sum(Amount) AS "sum"
				FROM DataPoints dp
					JOIN JournalEntry je on je.Id = dp.JournalEntryId
				WHERE DebitOrCredit = "debit" 
					AND AccountId = :id
					AND je.Posted = TRUE
		UNION
			SELECT "2",
				sum(Amount) 
				FROM DataPoints dp
					JOIN JournalEntry je on je.Id = dp.JournalEntryId
				WHERE DebitOrCredit = "Credit" 
					AND AccountId = :id
					AND je.Posted = TRUE
		UNION
			SELECT "3",
				NormalBalance
				FROM Account 
				WHERE Id = :id
		UNION
			SELECT "4",
				InitialBalance
				FROM Account
				WHERE Id = :id;';
		$bal = $pdo->prepare($balSql);
		$bal->bindValue(':id', $acctId);
		$bal->execute();
	} catch (PDOException $e) {
		$error = $e. 'Error Retriving Balance.';
		include '../error.html.php';
		exit();
	}
		$totalDebits = $bal->fetchColumn(1);
		$totalCredits = $bal->fetchColumn(1);
		$normBal = $bal->fetchColumn(1);
		$initBal = $bal->fetchColumn(1);

		if ($totalCredits > $totalDebits){
			$amount = $totalCredits - $totalDebits;
			$creditOrDebit = "CREDIT";
		}else if($totalCredits < $totalDebits){
			$amount = $totalDebits - $totalCredits;
			$creditOrDebit = "DEBIT";
		}else {
			$amount = 0;
			$creditOrDebit = $normBal;
		}
		$amount = $amount + $initBal;
		$accountInfo[] = array ('value'=>$amount,
						'creditOrDebit'=>$creditOrDebit,
						'normBal'=>$normBal);
	
	return $accountInfo;
}
