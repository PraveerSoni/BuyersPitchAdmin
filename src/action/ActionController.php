<?php
echo "Start...";
ob_start();
require_once '../batch/batchutil/GeneralBatchInclude.php';
require_once '../action/AbstractAction.php';
require_once '../action/LoginAction.php';
require_once '../action/BatchAction.php';
require_once '../action/LogoutAction.php';
require_once '../action/NonMatchDisplayAction.php';
require_once '../action/MapRequirementAction.php';
require_once '../action/HttpSession.php';
require_once '../action/NotificationTaxonomyMatchAction.php';
//session_start();
echo "Reached...";
HttpSession::getInstance();
echo "Session Got...";
$action='';
$redirect='';
try{
	$callingUrl=$_SERVER["HTTP_REFERER"];
	$logger = BatchUtil::getBatchLogger('ActionController.php');
	$logger->debug("Calling Url:: ".$callingUrl);
	if(isset($_REQUEST['hdnAction'])) {
		$action = $_REQUEST['hdnAction'];
	} elseif (isset($_POST['hdnAction'])) {
		$action = $_POST["hdnAction"];
	}
	$logger->debug("Action Hidden:: ".$action);
	if ($action == 'login') {
		$actionCls = new LoginAction();
		$redirect = $actionCls->executeAction($callingUrl);
	} elseif ($action == 'batchAction') {
		$actionCls = new BatchAction();
		$redirect = $actionCls->executeAction($callingUrl);
	} elseif ($action == 'logout') {
		$actionCls = new LogoutAction();
		$redirect=$actionCls->executeAction($callingUrl);
	} elseif ($action == 'nonMatchDisplay') {
		$actionCls = new NonMatchDisplayAction();
		$redirect=$actionCls->executeAction($callingUrl);
	} elseif($action == 'mapRequirement') {
		$actionCls = new MapRequirementAction();
		$redirect = $actionCls->executeAction($callingUrl);
		$actionCls = new NonMatchDisplayAction();
		$redirect=$actionCls->executeAction($callingUrl);
	} elseif($action == 'backToLogin') {
		$redirect = "Location: ../login/login.php";
	} elseif ($action == 'matchNotificationWithTaxonomy') {
		$actionCls = new NotificationTaxonomyMatchAction();
		$redirect = $actionCls->executeAction($callingUrl);
	}
	$logger->debug("Redirect url:: ".$redirect);
}catch (Exception $e) {
	$logger->debug("Exception is:: ".$e->getMessage());
}
header($redirect);
exit();
ob_flush();
?>