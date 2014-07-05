<?php
require_once ("../action/Session.php");
session_start();
class HttpSession implements Session {

	private $logger;

	private $sessionInfoArray;

	private static $instance = null;

	public static function getInstance() {
		if(self::$instance === null) {
			self::$instance = new HttpSession();
		}
		return self::$instance;
	}

	private function __construct() {
		$this->logger = BatchUtil::getBatchLogger('HttpSession.php');
		$this->sessionInfoArray = array();
	}

	public function putIntoSession($attributeName, $attributeValue) {
		foreach ($this->sessionInfoArray as $key=>$value) {
			if($key == $attributeName) {
				//$this->logger
				unset($this->sessionInfoArray[$attributeName]);
				break;
			}
		}
		$this->sessionInfoArray[$attributeName]=serialize($attributeValue);
	}

	public function getFromSessionByAttributeName($attributeName) {
		foreach ($this->sessionInfoArray as $key=>$value) {
			if($key == $attributeName) {
				return serialize($value);
			}
		}
		return null;
	}

	public function getAllFromSession() {
		return $this->sessionInfoArray;
	}

	public function removeFromSession($key) {
		foreach ($this->sessionInfoArray as $key=>$value) {
			if($key == $attributeName) {
				unset($this->sessionInfoArray[$attributeName]);
				break;
			}
		}
	}
}
?>