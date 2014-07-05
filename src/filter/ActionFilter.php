<?php
class ActionFilter {
	
	private $logger;
	
	public function __construct() {
		$this->logger = BatchUtil::getBatchLogger('ActionFilter.php');
	}
	
	public function doFilter($url) {
		$this->logger->debug("Url:: ".$url);
		$pos = strpos($url, '/login/');
		$this->logger->debug("Apply Filter Flag:: ".$pos);
		if($pos !== false) {
			$is_userSet=$_SESSION['is_userSet'];
			$this->logger->debug("Filter user check:: ".$is_userSet);
			if(null == $is_userSet || !isset($is_userSet)) {
				header("Location: ../login/logout.php");
				exit();
			}
		}
	}
}
?>