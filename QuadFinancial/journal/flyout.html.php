
<html lang="en"> 
	<head>
		<link rel="stylesheet" type="text/css" href="./flyout.css">
		<link rel="stylesheet" type="text/css" href="/QuadFinancial/menuTemplate4.css">
		<meta charset ="utf-8">
		<title>QuadAdministrator</title>
	</head>
	<body>
		<div id='cssmenu2' >
			<ul>
				<?php if(userHasRole(2)): ?><li><a href='/QuadFinancial/journal/'><spqn>Journal</span></a></li> <?php endif?>
				<li><a href='/QuadFinancial/journal/?pendingJournals'><span>Pending</span></a></li>
				<li><a href='/QuadFinancial/journal/?deletedJournals'><span>Deleted</span></a></li>
				<li class='last'><a href='/QuadFinancial/journal/?postedJournals'><span>Posted</span></a></li>
			</ul>
		</div>
	</body>
</html>
