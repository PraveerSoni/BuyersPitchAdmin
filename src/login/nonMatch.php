<?php
require_once '../domain/batchdomain/NotifyPost.php';
require_once '../domain/notificationMaster/NotificationDto.php';
session_start();
$notPostArray=null;
$notPostArray=unserialize($_SESSION['nonMatch']);
$notificationArray=unserialize($_SESSION['notification']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Admin Non Match Page</title>
</head>
<script type="text/JavaScript" src="../js/common.js"></script>
<script type="text/JavaScript" src="../js/batch.js"></script>
<body>
	<form action="../action/ActionController.php" id="nonMatchForm"
		method="post">
		<input type="hidden" id="hdnAction" name="hdnAction" />
		<?php  
		if (null != $notPostArray) {
				$cnt = count($notPostArray);
				?>
		<div align="left" style="width: 50%; float: left;">
			<table border="1">
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>Non Match Requirement Text</td>
					<td>Non Match Requirement Expiry Time</td>
					<td>Non Match Requirement User Name</td>
					<td>Non Match Requirement User Email</td>
				</tr>
				<?php 
				for ($i=0;$i<$cnt;$i++) {
					$nonMatchDto = $notPostArray[$i];
					$postDto = $nonMatchDto->getPostId();
					?>
				<tr>
					<td><input type="radio" name="notMatchId" id="nonMatchId"
						value="<?php echo $nonMatchDto->getNotifyPostId();?>" />
					</td>
					<td><?php echo $postDto->getPostText();?>
					</td>
					<td><?php echo $postDto->getEndDateTime();?>
					</td>
					<td><?php echo $postDto->getUserDetail()->getName();?>
					</td>
					<td><?php echo $postDto->getUserDetail()->getEmail();?>
					</td>
				</tr>
				<?php 
				}
				?>
			</table>
		</div>
		<?php  
		if (null != $notificationArray) {
				$cnt = count($notificationArray);
				?>
		<div align="right" style="width: 50%; float: left;">
			<table border="1">
				<tr>
					<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
					<td>Notification Key Words</td>
					<td>Email</td>
					<td>Mobile Number</td>
				</tr>
				<?php 
				for ($j=0;$j<$cnt;$j++) {
					$notification = $notificationArray[$j];
					?>
				<tr>
					<td><input type="checkbox" name="notificationId[]" id="notificationId[]"
						value="<?php echo $notification->getId();?>" />
					</td>
					<td><?php echo $notification->getKeywords();?>
					</td>
					<td><?php echo $notification->getEmail();?>
					</td>
					<td><?php echo $notification->getMobileNumber();?>
					</td>
				</tr>
				<?php 
				}
				?>
			</table>
		</div>
		<?php 
			}
			?>
              <div align="left" style="width: 50%; float: left;">
		<table>
			<tr>
				<td><input type="button" id="btnMap" name="btnMap"
					value="Map The Requirement"
					onclick="submitForm('nonMatchForm', 'mapRequirement');" /></td>
			</tr>
		</table>
</div>
		<?php }?>
<div align="right" style="width: 50%; float: left;">
		<table>
			<tr>
				<td><input type="button" id="btnMap" name="btnMap"
					value="Back"
					onclick="submitForm('nonMatchForm', 'backToLogin');" /></td>
			</tr>
		</table>
</div>
	</form>
</body>
</html>