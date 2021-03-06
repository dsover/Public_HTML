<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';

$fromRatio = TRUE;
include $_SERVER['DOCUMENT_ROOT'] . 'QuadFinancial/Reports/BalanceSheet/index.php';

$curAsset = getCurrentAssetsTotal();
$curLiab = getCurrentLiabTotal();
$inventories = getInventories();
$netSales = getNetSales(); //TotalSales - Sales Returns and Allowances - Sales Discounts
$name = '';


$debtToEquity = $sheTotal/$liabTotal; //total liabilities / shareholders equity
	$debtToEquityColor = getColor('debtToEquity',$debtToEquity);
$current = $curAsset/$curLiab; //current assets / current liabilities
	$currentColor = getColor('current',$current);
$quick = $curAsset/$inventories; //(current assets - inventories) /current liabilites
	$quickColor = getColor('quick',$quick);
$returnOnEquity = $netIncome/$sheTotal; //Net Income/ Shareholders Equity
	$returnOnEquityColor = getColor('returnOnEquity',$returnOnEquity);
$netProfitMargin = $netIncome/$netSales; //Net Profit / Net Sales
	$netProfitMarginColor = getColor('netProfitMargin',$netProfitMargin);

if (isset($_GET['thresholds'])){
	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	// Build the list of ratioThresholds
	try{
		$result = $pdo->query('SELECT rt.Id, 
								rt.Name,
								rt.High,
								rt.Low,
								rt.HigherIsBetter,
								u.UserName as LastEditor
							 FROM RatioThreshold rt
								join User u on u.Id = rt.UserId;');
	}catch (PDOException $e){
		$error = 'Error fetching list of ratio thresholds.';
		include 'error.html.php';
		exit();
	}
	foreach ($result as $row){
		$Ratios[] = array(
						'id' => $row['Id'],
						'name' => $row['Name'],
						'high' => $row['High'],
						'low' => $row['Low'],
						'higherIsBetter' => $row['HigherIsBetter'],
						'lastEditor' => $row['LastEditor'],
						'user' => $_SESSION['userName']);
	}
include 'ratioThresholdForm.html.php';
exit();}
if (isset($_POST['action']) and $_POST['action'] == 'update'){


	include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
	try{
		$sql = 'UPDATE RatioThreshold SET
								Name = :Name,
								High = :High,
								Low = :Low,
								HigherIsBetter = :HigherIsBetter,
								UserId = (select Id from User where UserName = :User)
								Where Id = :Id;';
	$s = $pdo->prepare($sql);
	$s->bindValue(':Name', $_POST['name']);
	$s->bindValue(':High', $_POST['high']);
	$s->bindValue(':Low', $_POST['low']);
	$s->bindValue(':HigherIsBetter', $_POST['higherIsBetter']);
	$s->bindValue(':Id',$_POST['id']);
	$s->bindValue(':User',$_POST['uname']);
	$s->execute();
	}catch (PDOException $e){
		$error = $e.'Error updating ratio threshold.';
		include '../error.html.php';
		exit();
	}
	header('Location: ./?thresholds');
	exit();
}

include 'ratios.html.php';


function getColor($ratioName,$value){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql1 = 'SELECT 
					Id,
					Name,
					High,
					Low,
					HigherIsBetter
				FROM RatioThreshold
				WHERE Name = :ratioName;
						';
			$ratios = $pdo->prepare($sql1);
			$ratios->bindValue(':ratioName', $ratioName);
			$ratios->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching ratio thresholds accounts.';
		include '/error.html.php';
		exit();
	}
	$row = $ratios->fetch();
	$higherIsBetter = $row['HigherIsBetter'];
	$high = $row['High'];
	$low = $row['Low'];
	if($higherIsBetter){
		if ($value > $high){return 'green';}
		else if ($value < $low){return 'red';}
		else {return 'yellow';}
	}else if (!$higherIsBetter){
		if ($value < $low){return 'green';}
		else if ($value > $high){return 'red';}
		else {return 'yellow';}
	}

}
function getNetSales(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql1 = 'SELECT 
					Id,
					CONCAT(Code," ",Name) AS codeName 
				FROM Account
				WHERE Deleted = FALSE
				AND CategoryId = 7
				ORDER BY Code;
						';
			$inventoriesResult = $pdo->prepare($sql1);
			$inventoriesResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching inventory accounts.';
		include '/error.html.php';
		exit();
	}
	foreach ($inventoriesResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$inventories = $inventories + $acctInfo[0]['value'];
		}else{
			$inventories = $inventories - $acctInfo[0]['value'];
		}
	}
	return $inventories;
}
function getInventories(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql1 = 'SELECT 
					Id,
					CONCAT(Code," ",Name) AS codeName 
				FROM Account
				WHERE Deleted = FALSE
				AND isInventory = 1
				ORDER BY Code;
						';
			$inventoriesResult = $pdo->prepare($sql1);
			$inventoriesResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching inventory accounts.';
		include '/error.html.php';
		exit();
	}
	foreach ($inventoriesResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$inventories = $inventories + $acctInfo[0]['value'];
		}else{
			$inventories = $inventories - $acctInfo[0]['value'];
		}
	}
	return $inventories;
}

function getCurrentAssetsTotal(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql1 = 'SELECT 
					Id,
					CONCAT(Code," ",Name) AS codeName 
				FROM Account
				WHERE Deleted = FALSE
				AND CategoryId = 1
				ORDER BY Code;
						';
			$curAssetsResult = $pdo->prepare($sql1);
			$curAssetsResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching current assets accounts.';
		include '../error.html.php';
		exit();
	}
	foreach ($curAssetsResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$curAssetTotal = $curAssetTotal + $acctInfo[0]['value'];
		}else{
			$curAssetTotal = $curAssetTotal - $acctInfo[0]['value'];
		}
	}
	return $curAssetTotal;
}
function getCurrentLiabTotal(){
	try{
		include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
			$sql2 = 'SELECT 
					Id,
					CONCAT(Code," ",Name) AS codeName 
				FROM Account
				WHERE Deleted = FALSE
				AND CategoryId = 4
				ORDER BY Code;
						';
			$curLilResult = $pdo->prepare($sql2);
			$curLilResult->execute();
	} catch (PDOException $e) {
		$error = 'Error fetching current liabilities accounts.';
		include '../error.html.php';
		exit();
	}
	foreach ($curLilResult as $row){
		$acctInfo = getAccountInfo($row['Id']);
		if ($acctInfo[0]['creditOrDebit'] == $acctInfo[0]['normBal']){
			$curLiabTotal = $curLiabTotal + $acctInfo[0]['value'];
		}else{
			$curLiabTotal = $curLiabTotal - $acctInfo[0]['value'];
		}
	}
return $curLiabTotal;
}
