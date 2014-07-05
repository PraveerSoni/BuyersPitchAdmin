<?php
require_once ('../batch/batchutil/AdminUIBatchSQLQueryConstant.php');
class TaxonomyDaoDb extends AbstractPDODB {

	private $logger;

	public function __construct() {
		$this->logger = BatchUtil::getBatchLogger('TaxonomyDaoDb.php');
	}

	public function getAllNonMatchTaxonomy($pageNo) {
		$nonMatchArray = null;
		$dbh = null;
		$this->logger->debug("Page No:: ".$pageNo);
		try {
			$sql = AdminUIBatchSQLQueryConstant::SQL_SEL_NON_MATCH;
			if(null != $pageNo) {
				$lowerLimit = $pageNo*10;
				$upperLimit = $lowerLimit+10;
				$sql = $sql." LIMIT ".$lowerLimit.", ".$upperLimit;
			}
			$this->logger->debug("Sql for Non Match:: ".$sql);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$nonMatchArray = array();
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$notfiyPost = new NotifyPost();
				$notfiyPost->setNotifyPostId($row->Notify_Post_NonMatch_Id);
				$postDetail = new PostDetailsDTO();
				$postDetail->setPostDetailsId($row->post_id);
				$postDetail->setPostText($row->Requirements);
				$postDetail->setEndDateTime($row->ExpireDateTime);
				$userDetail = new UserDetail();
				$userDetail->setFName($row->FirstName);
				$userDetail->setLName($row->LastName);
				$userDetail->setEmail($row->EmailAddress);
				$postDetail->setUserDetail($userDetail);
				$notfiyPost->setPostId($postDetail);
				array_push($nonMatchArray, $notfiyPost);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getPostByPostId:: ".$e->getMessage());
			$dbh = null;
		}
		if (null == $nonMatchArray || !isset($nonMatchArray) || !is_array($nonMatchArray)) {
			throw new NoDataFoundException("No Notification:: ", 4, null);
		}
		return $nonMatchArray;
	}

	public function getAllNonMatchTaxonomyByPages($startIndex) {
		$nonMatchArray = null;
		$dbh = null;
		$endIndex = $startIndex+10;
		try {
			$sql = AdminUIBatchSQLQueryConstant::SQL_SEL_NON_MATCH;
			$sql = $sql." LIMIT ".$startIndex.", ".$endIndex;
			$this->logger->debug("Sql for Non Match:: ");
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$nonMatchArray = array();
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$notfiyPost = new NotifyPost();
				$notfiyPost->setNotifyPostId($row->Notify_Post_NonMatch_Id);
				$postDetail = new PostDetailsDTO();
				$postDetail->setPostDetailsId($row->post_id);
				$postDetail->setPostText($row->Requirements);
				$postDetail->setPostEndDateTime($row->ExpireDateTime);
				$notfiyPost->setPostId($postDetail);
				array_push($nonMatchArray, $notification);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getPostByPostId:: ".$e->getMessage());
			$dbh = null;
		}
		if (null == $nonMatchArray || !isset($nonMatchArray) || !is_array($nonMatchArray)) {
			throw new NoDataFoundException("No Notification:: ", 4, null);
		}
		return $nonMatchArray;
	}

	public function insertNotifyPost($notifyPostArray) {
		$sql = BatchSQLQueryConstant::SQL_INS_NOTIFY_POST;
		$dbh = $this->formConnection();
		$dbh->beginTransaction();
		$cnt = count($notifyPostArray);
		$postId = '';
		for($i = 0; $i < $cnt; $i++) {
			$this->logger->debug("NotifyPost to insert:: ".$notifyPostArray[$i]);
			$postId = $notifyPostArray[$i]->getPostId()->getPostDetailsId();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $notifyPostArray[$i]->getPostId()->getPostDetailsId(), PDO::PARAM_INT);
			$stmt->bindParam(2, $notifyPostArray[$i]->getPostId()->getPostText(),PDO::PARAM_STR);
			$stmt->bindParam(3, $notifyPostArray[$i]->getNotificationEmail(),PDO::PARAM_STR);
			$stmt->bindParam(4, $notifyPostArray[$i]->getNotificationMobile(),PDO::PARAM_STR);
			$stmt->bindParam(5, $notifyPostArray[$i]->getPostId()->getEndDateTime());
			$stmt->execute();
		}
		$sql = AdminUIBatchSQLQueryConstant::SQL_DEL_NON_MATCH;
		$stmt = $dbh->prepare($sql);
		$stmt->bindParam(1, $postId, PDO::PARAM_INT);
		$stmt->execute();
		$dbh->commit();
		$dbh = null;
	}

	public function findAllNotificationTaxonomyMatch($pageNo) {
		$notificationArray = null;
		$dbh = null;
		$this->logger->debug("getAllNotificationTaxonomyMatch Page No:: ".$pageNo);
		try {
			$sql = AdminUIBatchSQLQueryConstant::SQL_SEL_NOT_TAXONOMY_MATCH;
			if(null != $pageNo) {
				$lowerLimit = $pageNo*10;
				$upperLimit = $lowerLimit+10;
				$sql = $sql." LIMIT ".$lowerLimit.", ".$upperLimit;
			}
			$this->logger->debug("Sql for getAllNotificationTaxonomyMatch:: ".$sql);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$nonMatchArray = array();
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$notification = new NotificationDto();
				$notification->setKeywords($row->Keywords);
				$notification->setEmail($row->EmailAddress);
				$notification->setMobileNumber($row->MobileNumber);
				$userDetail = new UserDetail();
				$userDetail->setFName($row->FirstName);
				$userDetail->setLName($row->LastName);
				$userDetail->setEmail($row->EmailAddress);
				$notification->setUserDetail($userDetail);
				array_push($notificationArray, $notification);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getPostByPostId:: ".$e->getMessage());
			$dbh = null;
		}
		if (null == $notificationArray || !isset($notificationArray) || !is_array($notificationArray)) {
			throw new NoDataFoundException("No Notification:: ", 4, null);
		}
		return $notificationArray;
	}

	public function findAllNotificationNullTaxonomyMatch($pageNo) {
		$notificationArray = null;
		$dbh = null;
		$this->logger->debug("getAllNotificationTaxonomyMatch Page No:: ".$pageNo);
		try {
			$sql = AdminUIBatchSQLQueryConstant::SQL_SEL_TAXONOMY_NULL;
			if(null != $pageNo) {
				$lowerLimit = $pageNo*10;
				$upperLimit = $lowerLimit+10;
				$sql = $sql." LIMIT ".$lowerLimit.", ".$upperLimit;
			}
			$this->logger->debug("Sql for getAllNotificationNonTaxonomyMatch:: ".$sql);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$nonMatchArray = array();
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$notification = new NotificationDto();
				$notification->setKeywords($row->Keywords);
				$notification->setEmail($row->EmailAddress);
				$notification->setMobileNumber($row->MobileNumber);
				$userDetail = new UserDetail();
				$userDetail->setFName($row->FirstName);
				$userDetail->setLName($row->LastName);
				$userDetail->setEmail($row->EmailAddress);
				$notification->setUserDetail($userDetail);
				array_push($notificationArray, $notification);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getPostByPostId:: ".$e->getMessage());
			$dbh = null;
			throw $e;
		}
		return $notificationArray;
	}

	public function findAllCategoryWithProducts($pageNumber) {
		$dbh = null;
		$this->logger->debug("findAllCategoryWithProducts Page No:: ".$pageNo);
		$sql = AdminUIBatchSQLQueryConstant::SQL_GET_ALL_PRODUCT;
		$taxonomyProductArray = array();
		if(null != $pageNo) {
			$lowerLimit = $pageNo*10;
			$upperLimit = $lowerLimit+10;
			$sql = $sql." LIMIT ".$lowerLimit.", ".$upperLimit;
		}
		try {
			$this->logger->debug("Sql for findAllCategoryWithProducts:: ".$sql);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$taxonomyProduct = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				$taxonomyProduct->setCategoryName($row->Category_Name);
				$taxonomyProduct->setProductBrand($row->brand);
				$taxonomyProduct->setProductCode($row->product_code);
				$taxonomyProduct->setProductName($row->Product_Name);
				$taxonomyProduct->setProductSubBrand($row->sub_brand);
				array_push($taxonomyProductArray, $taxonomyProduct);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getPostByPostId:: ".$e->getMessage());
			$dbh = null;
			throw $e;
		}
	}
}
?>