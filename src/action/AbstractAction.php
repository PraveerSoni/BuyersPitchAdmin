<?php
require_once '../filter/ActionFilter.php';
abstract class AbstractAction {
	
	protected $logger;
	
	public function __construct() {
		$this->logger = BatchUtil::getBatchLogger('Action.php');
	}
	
	public function executeAction($url) {
 		$filter = new ActionFilter();
 		$filter->doFilter($url);
		$redirectUrl = $this->execute();
		$this->logger->debug("Getting the redirection URL:: ".$redirectUrl);
		return $redirectUrl;
	}
	
	protected abstract function execute();
}
?>