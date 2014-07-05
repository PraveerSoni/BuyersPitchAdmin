<?php
require_once ("../batch/batchdto/BatchDetail.php");
interface BatchDataDaoFacade {
	
	function getBatchData(BatchType $batchType);
	
	function getAllNotification();
	
	function getAllMembers();
	
}
?>