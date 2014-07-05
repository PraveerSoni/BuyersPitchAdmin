<?php
require_once '../cli/BatchCli.php';
class BatchAction extends AbstractAction {

	public function __construct() {
		parent::__construct();
	}

	public function execute() {
		$cli = new BatchCli($_POST['batchTypeId']);
		$status = 'fail';
		try{
			$status = $cli->run();
		}catch (Exception $e) {
			$batchType = new BatchType();
			$batchType->setBatchTypeId($_POST['batchTypeId']);
			$batchType->setBatchRunStatus('N');
			$dao = new BatchDetailDAOImpl();
			$dao->uppdateBatchType($batchType);
			$status = $e->getMessage();
		}
		$this->logger->debug("End the Batch Process:: ".$status);
		//$_SESSION['batchJobMsg'] = $status;
// 		$batchType = new BatchType();
// 		$batchType->setBatchTypeId($_POST['batchTypeId']);
// 		$batchType->setBatchRunStatus('N');
// 		$dao = new BatchDetailDAOImpl();
// 		$dao->uppdateBatchType($batchType);
		$redirectUrl = "Location: ../login/login.php?msg=".$status;
		return $redirectUrl;
	}
}
?>