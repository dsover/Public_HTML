<?php if (!userIsLoggedIn()): ?>
<div id="header">
<table style="width:100%;margin-left:0px">
	<tr>
		<th style="border-width: 0px;background-image: -webkit-linear-gradient(left, #396D2E 0%, #91A88C 100%);padding-top:4px;"><a href="/QuadFinancial/"><img src="/QuadFinancial/images/quad.jpg" alt="quad logo" width="100" height="120"></a></th>
		<th style="border-width: 0px;background-color:#91A88C;"><h1>Quad-Financial Accounting System</h1></th>
		<th style="border-width: 0px;background-image:-webkit-linear-gradient(right, #396D2E 0%, #91A88C 100%);padding-top:4px;"><a href="/QuadFinancial/"><img src="/QuadFinancial/images/quad.jpg" alt="quad logo" width="100" height="120"></a></th>
	</tr>
</table>
	<?php include 'login.html.php'; 
	exit();
elseif ($_SESSION['passAge'] >= 90): 
	include 'oldpasswordchange.form.html.php';
	exit();
elseif ($_SESSION['changePass'] ):
	include 'oldpasswordchange.form.html.php';
	exit();
else:
?>
</div>
<div id="header">
<table style="width:100%;margin-left:0px">
	<tr >
		<th style="border-width: 0px;background-image: -webkit-linear-gradient(left, #396D2E 0%, #91A88C 100%);padding-top:4px;"><a href="/QuadFinancial/"><img src="/QuadFinancial/images/quad.jpg" alt="quad logo" width="100" height="120"></a></th>
		<th style="border-width: 0px;background-color:#91A88C;"><h1>Quad-Financial Accounting System</h1></br><?php include 'menu2.html.php' ?></th>
		<th style="border-width: 0px;background-image:-webkit-linear-gradient(right, #396D2E 0%, #91A88C 100%);padding-top:4px;"><a href="/QuadFinancial/"><img src="/QuadFinancial/images/quad.jpg" alt="quad logo" width="100" height="120"></a></th>
	</tr>
</table>
<table style="border:none;
		min-width:10px;
		width:10%;
		"
		align="right">
			<th style="border:none;position:fixed">Hello <?php htmlout($_SESSION['userName']); ?>!<?php include 'logout.inc.html.php'; ?></th>
</table>
</div>
<?php endif; ?>


