<?php
class LogoutAction extends AbstractAction {

	public function __construct() {
		parent::__construct();
	}

	protected function execute() {
		session_destroy();
		session_unset();
		$redirectUrl = "Location: ../index.php";
		return $redirectUrl;
	}
}
?>