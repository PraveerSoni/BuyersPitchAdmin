<?php
$notificatioArray = HttpSession::getInstance()->getFromSessionByAttributeName('notificationNullTaxonomy');
$categroyArray = HttpSession::getInstance()->getFromSessionByAttributeName('categorys');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Notification Taxonomy Match Page</title>
</head>
<script type="text/JavaScript" src="../js/common.js"></script>
<script type="text/JavaScript" src="../js/batch.js"></script>
<body>
	<form action="../action/ActionController.php"
		id="notificationTaxonomyMatch" method="post">
		<input type="hidden" id="hdnAction" name="hdnAction" />
		<?php  
		if (null != $notificationArray) {
				$cnt = count($notificationArray);
				?>
		<div align="left" style="width: 50%; float: left;">
			<table border="1">
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>Notification Text</td>
					<td>Notification User</td>
				</tr>
				<?php 
				for ($i=0;$i<$cnt;$i++) {
					$notification = $notificationArray[$i];
					?>
				<tr>
					<td><input type="radio" name="notMatchId" id="nonMatchId"
						value="<?php echo $notification->getId();?>" />
					</td>
					<td><?php echo $notification->getKeywords();?></td>
					<td><?php echo $notification->getUserDetail()->getFullName();?></td>
				</tr>
				<?php 
				}
				?>
			</table>
		</div>
		<?php }?>
	</form>
</body>
</html>
