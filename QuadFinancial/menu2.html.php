<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';
?>

<div id='cssmenu'>
	<ul>
		<li>
			<a href='/QuadFinancial/'><span>Home</span></a>
		</li>
	<?php if (userHasRole(1) ): ?>
		<li class='has-sub'><a href='/QuadFinancial/categories/'><span>Categories</span></a>
			<ul>
				<li><a href='/QuadFinancial/categories/?showcategories'><span>Categories</span></a>
				<li><a href='/QuadFinancial/categories/?showdeleted'><span>Deleted Categories</span></a>
				<li class='last'><a href='/QuadFinancial/categories/?add'><span>Add New Category</span></a></li>
			</ul>
		</li>
	<?php endif; ?>
	<?php if (userHasRole(1) ): ?>
		<li class='has-sub'><a href='/QuadFinancial/accounts/'><span>Accounts</span></a>
			<ul>
				<li><a href='/QuadFinancial/accounts/'><span>Accounts</span></a>
				<li class='last'><a href='/QuadFinancial/accounts/?add'><span>Add New Account</span></a></li>
			</ul>
		</li>
	<?php endif; ?>
	<?php if (userHasRole(1) ): ?>
		<li class='has-sub'><a href='/QuadFinancial/users/'><span>Users</span></a>
			<ul>
				<li><a href='/QuadFinancial/users/'><span>Active Users</span></a>
				<li class='last'><a href='/QuadFinancial/users/?inactiveUsers'><span>Inactivate Users</span></a></li>
				<li class='last'><a href='/QuadFinancial/users/?add'><span>Add New User</span></a></li>
			</ul>
		</li>
	<?php endif; ?>
		<li><a href='/QuadFinancial/chartOfAccounts/'><span>Chart Of Accounts</span></a></li>
		<li class='has-sub'><a 
						<?php if (userHasRole(2) ): ?>
							href='/QuadFinancial/journal/'
						<?php else: ?>
							href='/QuadFinancial/journal/?pendingJournals'
						<?php endif; ?>
						><span>Journal</span></a>
			<ul>
				<?php if (userHasRole(2) ): ?>
					<li><a href='/QuadFinancial/journal/'><span>Journal Entry</span></a>
				<?php endif; ?>
					<li><a href='/QuadFinancial/journal/?pendingJournals'><span>Pending</span></a></li>
					<li><a href='/QuadFinancial/journal/?deletedJournals'><span>Deleted</span></a></li>
					<li class='last'><a href='/QuadFinancial/journal/?postedJournals'><span>Posted</span></a></li>
			</ul>
		</li>
	<?php if (userHasRole(1) ): ?>
		<li class='has-sub'><a href='/QuadFinancial/Reports/'><span>Reports</span></a>
			<ul>
				<li><a href='/QuadFinancial/Reports/TrialBalance/'><span>Trial Balance</span></a></li>
				<li><a href='/QuadFinancial/Reports/IncomeStatement/'><span>Income Statment</span></a></li>
				<li><a href='/QuadFinancial/Reports/RetainedEarnings/'><span>Statement Of Retained Earnings</span></a></li>
				<li><a href='/QuadFinancial/Reports/BalanceSheet/'><span>Balance Sheet</span></a></li>
				<li><a href='/QuadFinancial/Reports/Ratios/'><span>Ratio Anlysis </span></a></li>
				<li class='last'><a href='/QuadFinancial/Reports/Ratios/?thresholds'><span>Ratio Thresholds</span></a></li>
			</ul>
		</li>
	<?php endif; ?>
		<li class='last'><a href='/QuadFinancial/FAQ/'><span>F.A.Q.</span></a></li>
	</ul>
</div>
