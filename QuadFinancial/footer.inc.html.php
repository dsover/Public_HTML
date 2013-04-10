<?php
	include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';
	require_once $_SERVER['DOCUMENT_ROOT'] . '/includes/access.inc.php';



		if (userHasRole(1) ): ?>
		<ul>
			<li><a href="/QuadFinancial/">Home</a></li>
			<li><a href="/QuadFinancial/categories/">Manage Account Categories</a></li>
			<li><a href="/QuadFinancial/accounts/" >Manage Accounts</a></li>
			<li><a href="/QuadFinancial/users">Manage users</a></li>
			<li><a href="/QuadFinancial/chartOfAccounts/">View Chart Of Accounts</a></li>
			<li><a href="/QuadFinancial/journal">Journal</a></li>
			<li><a href="/QuadFinancial/Reports"> Reports</a></li>
			<li><a href="/QuadFinancial/Reports/Ratios">Ratio Anlysis</a></li>
		</ul>
		<?php elseif(userHasRole(2) ): ?>
		<ul>
			<li><a href="/QuadFinancial/">Home</a></li>
			<li><a href="/QuadFinancial/chartOfAccounts/">View Chart Of Accounts</a></li>
			<li><a href="/QuadFinancial/journal">Journal</a></li>
		</ul>
		<?php endif; ?>

