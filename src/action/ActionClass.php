<?php
require_once ("../action/HttpSession.php");
abstract class ActionClass extends AbstractAction {
	
	private $session;
	
	public function __construct() {
		parent::__construct();
	}
	
	protected function execute() {
		$array = $this->doAction();
		$httpSession = HttpSession::getInstance();
		foreach ($array as $key=>$value) {
			if($key=='sessionInfo') {
				foreach ($value as $sessionKey=>$sessionValue) {
					
				}
			}		
		}
	}
	
	protected abstract function doAction();
	
	public function getSession() {
		if($this->session == null) {
			$this->session = new HttpSession();
		}
	}
}
?>