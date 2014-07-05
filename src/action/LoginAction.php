<?php
class LoginAction extends AbstractAction{

	public function __construct() {
		parent::__construct();
	}

	protected function execute() {
		$user = $_POST['txtAdminUserName'];
		$password = $_POST['txtAdminUserPassword'];
		$redirectUrl = "Location: ../index.php";
		if(strtolower($user) == 'buyerpitchktoadmin' && $password == 'buyerpitchktoadmin1232') {
			$_SESSION['user_pk_id']='ADMIN';
			$_SESSION['is_userSet']='T';
			$redirectUrl = "Location: ../login/login.php";
		} else {
			$redirectUrl = "Location: ../index.php?ref=true";
		}
		return $redirectUrl;
	}
}
?>