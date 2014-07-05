<?php
require_once ("../batch/serviceimpl/TaxanomyNonMatchServiceImpl.php");
class NonMatchDisplayAction extends AbstractAction {
	
	public function __construct() {
		parent::__construct();
	}
	
	protected function execute() {
		$this->logger->debug("Start Non Match Action::");
		$service = new TaxanomyNonMatchServiceImpl();
		$notArray = null;
		$notficationArray = null;
		try{
		$notArray = $service->getAllNonMatchTaxonomy();
		$service = new BatchDetailServiceImpl();
		$notficationArray = $service->getAllNotificationInfo();
		}catch (NoDataFoundException $nef) {
			$this->logger->error("Error is:: ".$nef->getMsg(),$nef);
		} catch (Exception $e) {
			$this->logger->error("Generic Error is:: ".$nef->getMsg(),$nef);
		}
		$this->logger->debug("Non Match Array:: ".$notArray);
		$this->logger->debug("Notification Array:: ".$notficationArray);
		$cnt = count($notArray);
		$_SESSION['nonMatch'] = serialize($notArray);
		$_SESSION['notification'] = serialize($notficationArray);
		$redirect = "Location: ../login/nonMatch.php";
		return $redirect;
	}
}
?>