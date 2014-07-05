<?php
require_once ("../batch/batchdto/BatchDetail.php");
interface BatchDetailDAO {

	function createBatchDetail(BatchDetail $batchDetail);

	function updateBatchDetail(BatchDetail $batchDetail);

	function updateLastId($id,$batchType);

	function getBatchTypeDetails($batchTypeId);

	function checkBatchRunningStatus($batchTypeId);

	function uppdateBatchType(BatchType $batchType);
}
?>