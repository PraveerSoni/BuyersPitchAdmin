<?php
require_once ("../exception/CoreException.php");
class BatchJobException extends CoreException {
	private $msgId;
	private $msg;
	private $trace;

	/**
	 * Constructor.
	 * @param unknown_type $message
	 * @param unknown_type $code
	 * @param unknown_type $trace
	 */
	public function __construct ($message, $code, $trace) {
		parent::__construct($message, $code, $trace);
		$this->msgId=$code;
		$this->msg=$message;
		$this->trace=$trace;
	}
}
?>