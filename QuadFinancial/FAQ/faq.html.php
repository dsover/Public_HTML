<?php include_once $_SERVER['DOCUMENT_ROOT'] . 'includes/helpers.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/access.inc.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<link rel="stylesheet" type="text/css" href="./faq.css">
		<title>FAQ</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<script src="/javascript/jquery-1.3.2.min.js"></script>
		<script src="./application.js"></script>
	</head>
	<body>
		<?php include '../header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="faqs" class="inthemiddle">
			<h1>FAQ/Help Manual</h1>
			<ol>
				<li>
					<span id="header" class="question">Login</span><br>
					<div id="sub" >
						<span>The steps to login.</span>
						<ol>	
							<li><span>The user selects the log in function.</span></li>
							<li><span>The user is taken to the log in page.</span></li>
							<li><span>The user is prompted for their login ID and password.</span></li>
							<li><span>The user enters their log in ID and password into the proper fields.</span></li>
							<li><span>The user selects enter.</span></li>
							<li><span>The system validates user’s log in ID and password information.</span></li>
							<li><span>The system accepts user’s log in ID and password information.</span></li>
						</ol>
						<p class="error">If the system does not allow the log in please see your manager or IT professional</p>
					</div>
				</li>
				<li>
					<span id="header" class="question">Change Password</span>
					<div id="sub" >
							<p><br><span>Once logged into the system check change Password located on the right of the screen.</span>
							<span>Once this is done the system will show the "Change your password" page. Here you will enter the new password. 
									Any password must be at least eight characters long. At any time during the process you may "log out" or
									"exit" while changing your password.</span> </p>
							<span>Steps to change password:</span>							
							<ol>
								<li><span>Enter new password in the first text field.</span></li>
								<li><span>Re-enter the new password in the second field.</span></li>
								<li><span>Click change password.</span></li>
								<li><span>Click "ok" on the pop up conformation.</span></li>
							</ol><br>
							<span  id="header" class="error">ERRORS:</span>
							<div class="errorText">
								<ul>
									<li><span class="errorDetail">Password must be at least 8 digits:</span>
											<span>This error notifies the user the entered password is too short. To continue:</span>
												<ol>				
												<li><span>Click "ok"</span></li>
												<li><span>Enter a password that is at least 8 characters long.</span></li>
												</ol>
									</li>
									<li><span class="errorDetail">Passwords do not match:</span>
											<span>This error notifies the user conformation password does not match the "new 	password".</span>
											<ol>					
												<li><span>Click "ok"</span></li>
												<li><span>Re-enter the conformation password</span></li>
												<li><span>Click "change password"</span></li>
											</ol>
									</li>
									<li><span class="errorDetail">Password Required:</span>
										<span>A password was not entered:</span>
										<ol>
											<li><span>Enter a password into the "new password" field</span></li>
											<li><span>Enter the same password just entered into the "Confirm password" field </span></li>
											<li><span>Click "change password"</span></li>
										</ol>		
									</li>
								</ul>
							</div>		
						</div><br>
				</li>
				<li>
					<span id="header" class="question">Journal</span>
					<div id="sub" >
						<span>A journal entry is composed of 7 parts.</span>
							<ol>
								<li><span>Select date</span></li>
								<li><span>Add description of the entry</span></li>
								<li><span>At least 2 accounts that have been selected from the drop down menu under the account tab.</span></li>
								<li><span>A debit must be selected for at least one account</span></li>
								<li><span>A credit must be selected for at least one account</span></li>
								<li><span>An amount of money must be entered for each account that is debited and credit. The amounts that you have entered must be equal. In the case that there are multiple debits and credits the amounts entered as debit must be equal to the amount of credits.</span></li>
								<li><span>The last thing to be done is to upload a source document by clicking "choose File". This will open a new window that will allow you to select a file from any folder/file that is an image. Currently the application does not support multiple file upload to work around this zip up files into an archive then upload the archive </span></li>
							</ol>
					
						<br>
						<p>To complete the journal entry click "Submit". A window will then appear 	asking for conformation.
							 Click "Ok" to submit the entry for approval by the management.</p>
				
						<br>
						<span id="header" class="error">ERRORS:</span>
							<div class="errorText">
								<ul>
									<li><span class="errorDetail">"Must enter a date"</span> --- click "OK"; enter a date in the date field</li>
									<li><span class="errorDetail">"Must have a description"</span> --- click "OK"; enter a description in the description field</li>
									<li><span class="errorDetail">"Must have at least 1 credit and one debit"</span> --- Select a debit for one account; Select a credit for one account</li>
									<li><span class="errorDetail">"Missing account"</span> --- select an account for every debit and credit</li>
									<li><span class="errorDetail">"Missing amount"</span> --- enter an amount for every debit and credit</li>
									<li><span class="errorDetail">"Debit/Credit must be equal"</span> --- make sure that the credit and debit values equal each other</li>
								</ul>
							</div>
					</div><br>
				</li>
				<li>
					<span id="header" class="question">Add new Accounts</span>
					<div id="sub" >
						<ol>
							<li><span>The user selects the add new Account from the Account tool bar.</span></li>
							<li><span>The user must enter "account name".</span></li>
							<li><span>The user must enter "account code".</span></li>
							<li><span>The user must enter "beginning balance".</span></li>
							<li><span>The user must enter "description of account".</span></li>
							<li><span>The user must select "normal balance".</span></li>
							<li><span>The user must select "type".</span></li>
							<li><span>The user must select "category".</span></li>
							<li><span>The user must select "is inventory".</span></li>
							<li><span>The user must click "add account".</span></li>
						</ol>
						<br>
						<span id="header" class="error">ERRORS:</span>
							<div class="errorText">
								<ul>
									<li><span>"Name must Be valid" --- click "ok" and enter a "account name".</span></li>
									<li><span>"Must enter a code" --- click "ok" and enter a "account code.</span></li>
									<li><span>"Must enter a Beginning Balance" --- click "ok" and enter a "beginning balance".</span></li>
									<li><span>"Must have a description" --- click "ok" and enter a "description".</span></li>
									<li><span>"Must have a Normal Balance" --- click "ok" and select a "normal balance".</span></li>
									<li><span>"Must select a type" --- click "ok" and select a "type".</span></li>
									<li><span>"Must select a category" --- click "ok" and select a "category".</span></li>
									<li><span>"Must select is inventory" --- click "ok" and select a "is inventory".</span></li>
								</ul>
							</div>
					</div><br>
				</li>
				<li>
					<span id="header" class="question">Chart Of Accounts</span>
						<div id="sub">
							<ol>
								<li><span><b>Chart of accounts ---</b> Can be accessed from the tool bar. Once accessed, click "view" to view the account ledger for a specific account</span></li>
								<li><span><b>Account Ledger ---</b>Contains detailed information about a specific account's posted journal entries</span></li>
							</ol>
						</div>
				</li>
				<li>
					<span id="header" class="question">Add new Users</span>
					<div id="sub" >
						<ol>
							<li><span>The system will show all the users on the system</span></li>
							<li><span>The manager will have the ability to "manage" the user accounts"</span></li>
							<li><span>The manager selects "add new user"</span></li>
							<li><span>The manager will add "user name"</span></li>
							<li><span>The manager will "set password"</span></li>
							<li><span>The manager will "confirm password"</span></li>
							<li><span>The manager will select "reset password on next login" (yes or no)</span></li>
							<li><span>The manager will select "roles" for the new user</span></li>
							<li><span>The manager will select "add user" to submit the new user account</span></li>
						</ol>
						<br>
						<span id="header" class="error">ERRORS:</span>
							<div class="errorText">
								<ul>
									<li><span>"Must have a user name" --- click "ok" and enter a name</span></li>
									<li><span>"Password must be at least 8 characters long" --- click "ok" and enter a password of at least 8 characters</span></li>
									<li><span>"Passwords don't match" --- click "ok"  and enter a matching password</span></li>
									<li><span>"Must have a password" --- click "ok" and enter a password</span></li>
									<li><span>"Must choose a role" --- click "ok" and select a role for the user</span></li>
								</ul>
							</div>
					</div><br>
				</li>
				<li>
					<span id="header" class="question">Add new Categories</span>
					<div id="sub" >
						<ol>
							<li><span>Enter a "Name"</span></li>
							<li><span>Enter a "Description"</span></li>
							<li><span>Click "Add category"</span></li>
							<li><span>Click "Ok" once the pop up conformation appears</span></li>
						</ol>
						<br>
						<span id="header" class="error">ERRORS:</span>
							<div class="errorText">
								<ul>
									<li><span>"Must enter a Name" --- click "ok" and enter a name</span></li>
									<li><span>"Must have a description" --- click "ok" and enter a description</span></li>
								</ul>
							</div>
					</div><br>
				</li>
				<li>
					<span id="header" class="question">Reports</span>
					<div id="sub" >
						<p>List of system reports that can be accessed from the tool bar</p>
						<ol>
							<li><span>Trail Balance</span></li>
							<li><span>Income Statement</span></li>
							<li><span>Statement of Retained Earrings</span></li>
							<li><span>Balance Sheet</span></li>
							<li><span id="header" class="question">Ratio Analysis</span>
								<div id="sub">
									<ol>
										<li><span><b>Debt to Equity Ratio ---</b> A measure of a company's financial leverage calculated by dividing its total liabilities by stockholders' equity. It indicates what proportion of equity and debt the company is using to finance its assets.</span></li>
										<li><span><b>Current Ratio ---</b> A liquidity ratio that measures a company's ability to pay short-term obligations.</span></li>
										<li><span><b>Quick Ratio ---</b> An indicator of a company's short-term liquidity. The quick ratio measures a company's ability to meet its short-term obligations with its most liquid assets. The higher the quick ratio, the better the position of the company.</span></li>
										<li><span><b>Return on Equity (ROE) ---</b> The amount of net income returned as a percentage of shareholders equity. Return on equity measures a corporation's profitability by revealing how much profit a company generates with the money shareholders have invested. </span></li>
										<li><span><b>Net Profit Margin ---</b> A ratio of profitability calculated as net income divided by revenues, or net profits divided by sales. It measures how much out of every dollar of sales a company actually keeps in earnings. Profit margin is very useful when comparing companies in similar industries. A higher profit margin indicates a more profitable company that has better control over its costs compared to its competitors. Profit margin is displayed as a percentage; a 20\% profit margin, for example, means the company has a net income of $0.20 for each dollar of sales.</span></li>
									</ol>
								</div>
							</li>
							<li><span id="header" class="question">Ratio Threshold</span>
								<div id="sub">
									<p>The Ratio thresholds are avalible for managers to set the trigger levels for the ratio dashboard each line must be saved individualy</p>
									<ol>
										<li><span><b>High --- </b>This is the upper boundry for the ratio</span></li>
										<li><span><b>Low --- </b>This is the lower boundry for the ratio</span></li>
										<li><span><b>IsHighBetter --- </b>This toggles how the dashboard responds to values. If set to yes, when ratio the value goes above the "High" boundry a green light will be shown; if no then when the ratio value over the "High" boundry a red light will be shown.</span></li>
									</ol>
								</div>
							</li>
						</ol>
					</div><br>
				</li>
			</ol>
		</div>
	</body>
</html>
