<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/helpers.inc.php'; 
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';?>



<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<link rel="stylesheet" type="text/css" href="/javascript/jquery.AddIncSearch-master/jquery.AddIncSearch.css">
		<title>Journal</title>
		<script src="/javascript/javascript_form/gen_validatorv4.js" type="text/javascript"></script>
		<script type="text/javascript" src="/javascript/jquery-1.3.2.min.js"></script>
		 <script type="text/javascript" src="/javascript/jquery.AddIncSearch-master/jquery.AddIncSearch.js"></script>
		 <script type="text/javascript">
		 jQuery(document).ready(function() {
		    jQuery("select").AddIncSearch({
			maxListSize: 5,
			maxMultiMatch: 15,
			warnMultiMatch: 'top {0} matches ...',
			warnNoMatch: 'no matches ...'
		    });
		 });
	 </script>
	</head>
	<body>
		<?php if($review !=1){ include $_SERVER['DOCUMENT_ROOT'] .'/QuadFinancial/header.inc.html.php'; } ?>
		<?php if (userHasRole(1)  and $review!=1 ){exit();}?>
		<?php if(!$review): ?>
			<?php include $_SERVER['DOCUMENT_ROOT'] .'QuadFinancial/journal/flyout.html.php' ?>
			<div id="singleJournalView" >
		<?php endif ?>
		<form name="journal" action="?" id="journal" method="post" enctype="multipart/form-data">
			Date: <input type="date" name="journalEntryDate" value="<?php htmlout($date); ?>" <?php if($review ==1){htmlout('readonly');}?>></br>
			<textarea placeholder="Reason for the journal entry" cols="70" rows="3" name="description" id="description" maxlength="215" <?php if($review ==1){htmlout('readonly');}?>><?php htmlout($description); ?></textarea>
			<h1 style="color:red;"><?php htmlout($creditError); ?></h1>
			<table id="dataPoints">
				<tr>
					<th>Account</th>
					<th>Debit</th>
					<th>Credit</th>
					<th>Amount</th>
				</tr>
					<?php for ($i = 0; $i < $_SESSION['$journalLineItems']; $i++): ?>
				<tr>
					<td><select name="<?php htmlout('account[]'); ?>" <?php if($review ==1){htmlout('disabled');}?>>
							<option value="" ></option>
							<?php foreach ($accounts as $account): ?>
								<option value="<?php htmlout($account['accountId']);?>"
										<?php if($account['accountId'] == $lineItem[$i]['accountId']){ htmlout('selected="selected"');} ?>>
												<?php htmlout($account['accountCode'].' '.$account['accountName']. ' - '. $account['categoryName']); ?></option>
							<?php endforeach; ?>
							<input type="hidden" name="lineIds[]" value="<?php htmlout($i); ?>">
						</select></td>
					<td><input type="radio" name="<?php htmlout('debit[]'.$i); ?>" value="none" checked style="display:none;">
						<input type="radio" name="<?php htmlout('debit[]'.$i); ?>" value="debit" <?php if($lineItem[$i]['debitOrCredit']=='debit') {htmlout('checked');}elseif($review ==1){htmlout('disabled');}?>/></td>
					<td><input type="radio" name="<?php htmlout('debit[]'.$i); ?>" value="credit" <?php if($lineItem[$i]['debitOrCredit']=='credit') {htmlout('checked');}elseif($review ==1){htmlout('disabled');}?> /></td>
					
					<td><input type="text"
								size="10"
								placeholder="amount"
								name="currency[]"
								value = "<?php if(review == 1){htmlout(curFormat($currency[$i]));}else{htmlout(curFormat($lineItem[$i]['currency']));} ?>"
								pattern="^\d*(\.\d{2}$)?" size="4"
								title="Currency Format - no dollar sign and no comma(s) - cents (.##) are optional"
								<?php if($review ==1){htmlout('readonly');}?>/>
					<b style="color:red;"><?php htmlout($lineError[$i]['text']);?></b></td>
				</tr>
					<?php endfor; ?>
			</table>
			<?php if($review !=1): ?> <input type="image" src="/QuadFinancial/images/plus.png" height="24" width="24" border="0" ALT="action" name="action" value="addLine"></br><?php endif; ?>
			<input type="hidden" name="journalId" id="journalId" value="<?php htmlout($journalId); ?>">
			<label for="file" disabled>Filename:</label>
				<?php if($review == 1):?>
					<?php if($fileName):?>
						<a href="?getFile=<?php htmlout($journalId); ?>"><?php htmlout($fileName);?></a> <br>
					<?php else:htmlout('No File for this Post');?>
					<?php endif; echo '</br>';?><?php endif;?>
				<?php if($review !=1 ): ?>
				<input type="hidden" name="MAX_FILE_SIZE" value="16000000">
				<input type="file" name="file" id="file"><br>
				<?php endif;?>
			<?php if($review !=1 ): ?><input type="submit" name="action" value="Submit" onclick="return confirm('Are you sure you want to submit this item?');"><?php endif; ?>
			<?php if($review ==1 and $header == 'Pending' and userHasRole(1)): ?><input type="submit" name="postEntry" value="Post Journal Entry" onclick="return confirm('Are you sure you want to post this item?');"><?php endif; ?>
			<?php if($review ==1 and $header == 'Pending' and userHasRole(1)): ?><input type="submit" name="deleteEntry" value="Delete Journal Entry" onclick="return confirm('Are you sure you want to delete this item?');"><?php endif; ?>
			<?php if($review ==1 and $header == 'Deleted' and userHasRole(1)): ?><input type="submit" name="unDeleteEntry" value="Un-Delete Journal Entry" onclick="return confirm('Are you sure you want to Un-delete this item?');"><?php endif; ?>

		</form>

		<script type="text/javascript">
			 var frmvalidator  = new Validator("journal");
			frmvalidator.addValidation("journalEntryDate","req","Must enter a Date"); 
		</script>
			</br>
			</br>
		<?php if($review ==1 ): ?><b>Created By: &nbsp<?php htmlout($user);?></b><?php endif?>
		<?php if($header == 'Pending' ): ?><br><b>Date Created: <?php htmlout($changeDate);?></b> <?php endif?>
		<?php if($header == 'Deleted'): ?><br><b>Deleted By:&nbsp&nbsp&nbsp<?php htmlout($admin);?></b><br><b>Date Deleted: <?php htmlout($changeDate);?></b><?php endif?>
		<?php if($header == 'Posted' || $header == 'Single'): ?><br><b>Posted By:&nbsp&nbsp&nbsp <?php htmlout("$admin");?></b><br><b>Date Posted: <?php htmlout($changeDate);?></b><?php endif?>

		<?php if(!$review): ?></div><?php endif ?>
	</body>
</html>
