<?php
require_once '../batch/serviceimpl/TaxanomyNonMatchServiceImpl.php';
class NotificationTaxonomyMatchAction extends AbstractAction {


	public function __construct() {
		parent::__construct();
	}

	protected function execute() {
		$service = new TaxanomyNonMatchServiceImpl();
		$errorMsg=null;
		$redirect = "Location: ../login/notificationTaxonomyMatch.php";
		try {
			$notficationArray = $service->getNullNotificationTaxonomy(null);
			$categoryArray = $service->getAllProductCategoryMap(null);
			HttpSession::getInstance()->putIntoSession("notificationNullTaxonomy", $notficationArray);
			HttpSession::getInstance()->putIntoSession("categorys", $categoryArray);
		} catch (Exception $e) {
			$this->logger->error("Error is:: ".$e->getMessage(), $e);
			$errorMsg = $e->getMessage();
			$redirectUrl = $redirect."?msg=".$errorMsg;
		}
		return $redirect;
	}
}
?>