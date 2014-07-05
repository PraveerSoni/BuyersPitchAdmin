<?php
$msg = "";
if(isset($_REQUEST['msg'])) {
	$msg=$_REQUEST['msg'];
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Login Page</title>
</head>
<script type="text/JavaScript" src="../js/common.js"></script>
<script type="text/JavaScript" src="../js/batch.js"></script>
<body>
	<?php if ($msg != "") {?>
	<b><?php echo $msg;?> </b>
	<?php }?>
	<form action="../action/ActionController.php" id="batchForm"
		method="post" onsubmit="setAction('batchExecute')">
		<div align="left" style="width: 50%; float: left;">
			<input type="hidden" id="hdnAction" name="hdnAction" /> <input
				type="hidden" id="batchTypeId" name="batchTypeId" /> <input
				type="button" id="btnEmailBid" name="btnEmailBid"
				value="Mail Bid Notification"
				onclick="setBatchType('2'); submitForm('batchForm','batchAction')" /><br />
			<input type="button" id="btnEmailRequirements"
				name="btnEmailRequirements" value="Mail Requirement Notification"
				onclick="setBatchType('1'); submitForm('batchForm','batchAction')" /><br />
			<input type="button" id="btnMatchReqTaxanomy"
				name="btnMatchReqTaxanomy" value="Match Request Taxanomy"
				onclick="setBatchType('4'); submitForm('batchForm','batchAction')" /><br />
			<input type="button" id="btnMatchAlertTaxanomy"
				name="btnMatchAlertTaxanomy" value="Match Notification Taxanomy"
				onclick="setBatchType('5'); submitForm('batchForm','batchAction')" /><br />
			<input type="button" id="btnMatchTaxanomy" name="btnMatchTaxanomy"
				value="Match Taxanomy"
				onclick="setBatchType('6'); submitForm('batchForm','batchAction')" /><br />

			<input type="button" id="btnMatchNotification"
				name="btnMatchNotification" value="Notification Taxonomy Match"
				onclick="submitForm('batchForm','notificationTaxonomyMatch')" /><br />
			<input type="button" id="btnMatchRequest" name="btnMatchRequest"
				value="Request Taxonomy Match"
				onclick="submitForm('batchForm','requestTaxonomyMatch')" /><br /> <input
				type="button" id="btnLogout" name="btnLogout" value="logout"
				onclick="submitForm('batchForm','logout')" /><br />
		</div>
		<div align="right" style="width: 50%; float: left;">
			<input type="button" id="btnMatchNonMatchTaxanomy"
				name="btnMatchNonMatchTaxanomy" value="Match Non Match Taxanomy"
				onclick="submitForm('batchForm','nonMatchDisplay')" /><br />
			<input type="button" id="btnMatchNotificationTaxanomy" name="btnMatchNotificationTaxanomy"
			value="Match Alerts With Taxonomy"
			onclick="submitForm('batchForm','matchNotificationWithTaxonomy')" /><br />	
		</div>
	</form>
</body>
</html>
