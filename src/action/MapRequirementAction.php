<?php
class MapRequirementAction extends AbstractAction {

	public function __construct() {
		parent::__construct();
	}

	protected function execute() {
		$redirect = "Location: ../login/nonMatch.php";
		$notMatchId = $_POST['notMatchId'];
		$this->logger->debug('Non Match notMatchId:: '.$notMatchId);
		$nonMatchDto = $this->getNonMatchDetails($notMatchId);
		$notMatchArray = array();
		$batchDetailService = new TaxanomyNonMatchServiceImpl();
		$notMatchArray = $this->notificationData($nonMatchDto);
		$batchDetailService->insertNotifyPost($notMatchArray);
		$this->logger->debug("Redirect after Map:: ".$redirect);
		return $redirect;
	}

	private function notificationData(NotifyPost $nonMatchDto) {
		$notMatchArray = array();
		$notfication = $_POST['notificationId'];
		$cnt = count($notfication);
		$this->logger->debug('Count of Notification Id:: '.$cnt);
		for($i = 0; $i < $cnt; $i++) {
			$notificationDto = $this->getNotificationData($notfication[$i]);
			$map = new NotifyPost();
			$map->setNotifyPostId($nonMatchDto->getNotifyPostId());
			$post = $nonMatchDto->getPostId();
			$map->setPostId($post);
			$map->setNotificationEmail($notificationDto->getEmail());
			$map->setNotificationMobile($notificationDto->getMobileNumber());
			$map->setNotificationKeyWords($notificationDto->getKeywords());
			$this->logger->debug("Map:: ".$map);
			array_push($notMatchArray, $map);
		}
		return $notMatchArray;
	}

	private function getNonMatchDetails($notMatchId) {
		$this->logger->debug('Non Match notMatchId:: '.$notMatchId);
		$notMatchArray = unserialize($_SESSION['nonMatch']);
		$cnt = count($notMatchArray);
		$this->logger->debug("Cnt for getNonMatchDetails:: ".$cnt);
		for($i = 0; $i < $cnt; $i++) {
			$nonMatchDto = $notMatchArray[$i];
			if($nonMatchDto->getNotifyPostId() == $notMatchId) {
				$this->logger->debug("Found Match For:: ".$notMatchId);
				return $nonMatchDto;
			}
		}
	}

	private function getNotificationData($notificationId) {
		$notificationArray = unserialize($_SESSION['notification']);
		$cnt = count($notificationArray);
		$this->logger->debug("Cnt for getNotificationData:: ".$cnt);
		for($i = 0; $i < $cnt; $i++) {
			$notification = $notificationArray[$i];
			if($notificationId == $notification->getId()) {
				$this->logger->debug('Notification Id:: '.$notification->getId());
				return $notification;
			}
		}
	}
}
?>