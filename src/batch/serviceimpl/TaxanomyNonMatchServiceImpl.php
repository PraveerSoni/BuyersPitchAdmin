<?php
require_once ("../batch/batchdaoimpl/TaxonomyDaoDb.php");
class TaxanomyNonMatchServiceImpl {

	private $logger;

	public function __construct() {
		$this->logger = BatchUtil::getBatchLogger('TaxonomyMatcherServiceImp.php');
	}

	public function getAllNonMatchTaxonomy() {
		$dao = new TaxonomyDaoDb();
		$notArray = $dao->getAllNonMatchTaxonomy();
		return $notArray;
	}

	public function insertNotifyPost($notifyPostArray) {
		$dao = new TaxonomyDaoDb();
		$dao->insertNotifyPost($notifyPostArray);
	}

	public function getMatchedNotificationTaxonomy() {
		$dao = new TaxonomyDaoDb();
		$dao->getAllNotificationTaxonomyMatch(null);
	}

	public function getNullNotificationTaxonomy($pageNumber) {
		$dao = new TaxonomyDaoDb();
		$notificationArray = $dao->findAllNotificationNullTaxonomyMatch($pageNumber);
		if (null == $notificationArray || !isset($notificationArray) || !is_array($notificationArray)) {
			throw new NoDataFoundException("No Notification that is not matched to any taxonomy:: ", 4, null);
		}
	}

	public function getAllProductCategoryMap($pageNumber) {
		$dao = new TaxonomyDaoDb();
		$categoryArray = array();
		$productCategoryMapArray = $dao->findAllCategoryWithProducts($pageNumber);
		if (null == $productCategoryMapArray || !isset($productCategoryMapArray) || !is_array($productCategoryMapArray)) {
			throw new NoDataFoundException("No Data in Product Category Map:: ", 4, null);
		}
		foreach ($productCategoryMapArray as $key=>$value) {
			$category = new Category($value->getCategoryId());
			foreach ($categoryArray as $cateKey=>$catValue) {
				if($cateKey == $value->getCategoryId()) {
					$category = $catValue;
					break;
				}
			}
			$category = $value->formCategoryUsingData($category);
			$categoryArray[$value->getCategoryId()] = $category;
		}
		return $categoryArray;
	}
}
?>