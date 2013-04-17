<?php include_once $_SERVER['DOCUMENT_ROOT'] . 'includes/helpers.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/includes/access.inc.php'; ?>

<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type="text/css" href="../mystyle.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/flyout.css">
		<title>Chart Of Accounts</title>
		<meta http-equiv="content-type"
			content="text/html; charset=utf-8"/>
	</head>
	<body>
		<?php include '../header.inc.html.php'; ?>
		<?php include './flyout.html.php'?>
		<div id="faq">
<pre>










Q&A - help manual
1. Login
	The steps to login.
The user selects the log in function.
The user is taken to the log in page.
The user is prompted for their login ID and password.
The user enters their log in ID and password into the proper fields.
The user selects enter.
The system validates user’s log in ID and password information.
The system accepts user’s log in ID and password information.

	If the system does not allow the log in please see your manager or IT professional

2. Change Password
	Once logged into the system check change Password located on the right of the screen.
	once this is done the system will show the change your password page. Here you will 	enter the new password. Any password must be at least eight characters long. At any 	time during the process you may "log out" or "exit" while changing your password. 
	Steps:
enter new password in the first text field.
re-enter the new password in the second field.
click change password.
click "ok" on the pop up conformation.

	 ERRORS:
	"password must be at least 8 digits"
	This error notifies the user the entered password is too short. To continue:
click "ok"
enter a password that is at least 8 characters long.
	
	"password don't match"
	This error notifies the user conformation password does not match the "new 	password".
click "ok" 
re-enter the conformation password
click "change password"

	"Password Required" - a password was not entered
enter a password into the "new password" field
enter the same password just entered into the "Confirm password" field 
click " change password"
	
3. Home menu
	The home screen for Management and Employee varies. Please select your respected role as to not get confused. 
4. Tool bar
a. Employee home menu
i. Home
The home button of the tool bar or side bar will take you back to the 'home screen where journal entries may be entered in the journal window.
ii. Journal
A journal entry is composed of 7 parts.
	1. Select date
	2. Add description of the entry
	3. At least 2 accounts that have been selected from the drop down 		    menu under the account tab.
	4. A debit must be selected for at least one account
	5. A credit must be selected for at least one account
	6. An amount of money must be entered for each account that is 	     	    debited and credit. The amounts that you have entered must be 	   	    equal. In the case that there are multiple debits and credits the 		    amounts entered as debit must be equal to the amount of credits.  
	7. The last thing to be done is to upload a source document by clicking 		    "choose File". This will open a new window that will allow you to 	    	      select a file from any folder/file that is an image.
	To complete the journal entry click "Submit". A window will then appear 	asking for conformation. Click "Ok" to submit the entry for approval by 	the management.

ERRORS:
"must enter a date" pop up window 
click "OK" 
enter a date in the date field

"Must have a description" pop up window
click "OK"
enter a description in the description field

"Must have at least 1 credit and one debit" Red error 
Select a debit for one account
Select a credit  for one account

"Missing account" Red error
select an account for every debit and credit
 "Missing amount" Red error
enter an amount for every debit and credit

"Debit/Credit must be equal" Red error
the debit and credits are not equal



iii. Home 
By clicking the "Home" button the user will be directed to the home page.
iv. Chart of Accounts - from the drop down tool bar
Selections:
	Account Ledger
		Allows the user to view the Ledger
	
	Chart of accounts
		Will show the user the Char of accounts 
	From this view the user can select an account to view by
clicking "view" beside the account the user wants to view.

b. Management home menu
i. Home
		By clicking the "Home" button the user will be directed to the home page.

ii. Categories
1. Categories
This view allows the user to view all the categories and either edit or delete a category.
To Delete a category 
click "Delete" below the category that you want to delete

2. Add new Categories
enter a "Name"
enter a "Description"
click "Add category"
click "Ok" once the pop up conformation appears

iii. Accounts
1. Accounts
Allows the user to search and view accounts
Search: the user has a few options on how to search for an account
Search by Name
Search by description
Search by user
Search by Category
Search by Deleted
click "search"

2. Add new Accounts
The user selects the add new Account from the Account tool bar.
The user must enter "account name".
The user must enter "account code".
The user must enter "beginning balance".
The user must enter "description of account".
The user must select "normal balance".
The user must select "type".
The user must select "category".
The user must select "is inventory".
The user must click "add account".

ERRORS:

"Name must Be valid"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and enter a "account name".

"Must enter a code"
Pre-condition: The log in ID or password is not accepted by the system.
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and enter a "account code".

Must enter a Beginning Balance"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and enter a "beginning balance".



"must have a descrption"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and enter a "description".

"must have a Normal Balance"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and select a "normal balance".

"must select a type"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and select a "type".

"must select a category "
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and select a "category".

"must select is inventory"
click " adding new account " before entering a name.
the user will receive a pop up window.
click "ok" and select a "is inventory".


iv. Users
1. Users
2. Add new Users
the system will show all the user accounts on the system
the manager will have the ability to "manage" the user accounts"
the manager selects "add new user"
the manager will add "user name"
the manager will "set password"
the manager will "confirm password"
the manager will select "reset password on next login" (yes or no)
the manager will select "roles" for the new user
the manager will select "add user" to submit the new user account
ERRORS
must have a user name:
1. click " change password" before any info.
2. the user will receive a pop up window.
3. "must have a user name".
4. click "ok".

password must be at least 8 characters long:

1. click " change password" entering a password less than 8 characters.
2. the user will receive a pop up window.
3. "password must be at least 8 characters long".
4. click "ok"

manage user function
1. click " change password" before entering a password.
2. the user will receive a pop up window.

passwords don't match:
1. click " change password" entering a password and not confirming password.
2. the user will receive a pop up window.
3. "passwords don't match".
4. Click "ok".

must have a password:
1. click " change password" entering a password that exists.
2. the user will receive a pop up window.
3. "must have a password"
4. click "ok".

must choose a role:
1. click " change password" before selecting a roles.
2. the user will receive a pop up window.
3. "must choose a role".
4. click "ok".

v. Chart of Accounts
Allows the user to view the Chart of Accounts
vi. Journal
1.  Pending
Allows the manger to post or delete a journal entry if there is an entry pending
by clicking either
"Post journal entry" - will post entry
"Delete journal entry" - will delete entry
2. Deleted
Allows the manger to undelete a previously deleted journal entry
3. Posted
				Show the manger all the posted journal entries.


4. posting
	1. Select date
	2. Add description of the entry
	3. At least 2 accounts that have been selected from the drop down 		    menu under the account tab.
	4. A debit must be selected for at least one account
	5. A credit must be selected for at least one account
	6. An amount of money must be entered for each account that is 	     	    debited and credit. The amounts that you have entered must be 	   	    equal. In the case that there are multiple debits and credits the 		    amounts entered as debit must be equal to the amount of credits.  
	7. The last thing to be done is to upload a source document by clicking 		    "choose File". This will open a new window that will allow you to 	    	      select a file from any folder/file that is an image.
	To complete the journal entry click "Submit". A window will then appear 	asking for conformation. Click "Ok" to submit the entry for approval by 	the management.

ERRORS:
"must enter a date" pop up window 
click "OK" 
enter a date in the date field

"Must have a description" pop up window
click "OK"
enter a description in the description field

"Must have at least 1 credit and one debit" Red error 
Select a debit for one account
Select a credit  for one account

"Missing account" Red error
select an account for every debit and credit
 "Missing amount" Red error
enter an amount for every debit and credit

"Debit/Credit must be equal" Red error
the debit and credits are not equal


vii. Reports
1. Trail Balance
shows Trail Balance
2. Income Statement
Shows Income Statement
3. Statement of Retained Earrings
shows Statement of Retained Earrings
4. Balance Sheet
Shows Balance sheet
5. Ratio Analysis
Shows Ratio Analysis
6. Ratio Threshold
Shows Ratio Threshold

5. Management Ratio window
a. Debt to Equity Ratio
A measure of a company's financial leverage calculated by dividing its total liabilities by stockholders' equity. It indicates what proportion of equity and debt the company is using to finance its assets.
b. Current Ratio
A liquidity ratio that measures a company's ability to pay short-term obligations. 
c. Quick Ratio
An indicator of a company's short-term liquidity. The quick ratio measures a company's ability to meet its short-term obligations with its most liquid assets. The higher the quick ratio, the better the position of the company.
d. Return on Equity (ROE)
The amount of net income returned as a percentage of shareholders equity. Return on equity measures a corporation's profitability by revealing how much profit a company generates with the money shareholders have invested. 
e. Net Profit Margin
A ratio of profitability calculated as net income divided by revenues, or net profits divided by sales. It measures how much out of every dollar of sales a company actually keeps in earnings.
Profit margin is very useful when comparing companies in similar industries. A higher profit margin indicates a more profitable company that has better control over its costs compared to its competitors. Profit margin is displayed as a percentage; a 20\% profit margin, for example, means the company has a net income of $0.20 for each dollar of sales. 


 
			

</pre>
		</div>
	</body>
</html>
