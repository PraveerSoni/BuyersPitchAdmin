<?php
require_once ("../persistence/AbstarctPDODB.php");
require_once ("../batch/batchdao/TaxonomyDao.php");
require_once ("../exception/InternalException.php");
class TaxonomyDaoImpl extends AbstractPDODB implements TaxonomyDao {

	private $logger;

	public function __construct() {
		$this->logger=BatchUtil::getBatchLogger('TaxonomyDaoImpl.php');
	}

	public function findProductMap($string,$categoryIdArray=null,$productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_MAP;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for Product Map for String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $productIdMap;
	}

	public function findProductSynonnymMap($string, $categoryIdArray=null, $productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_SYN_MAP;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'ps.Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for Product Synonym Map For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			$dbh = null;
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
		}
		return $productIdMap;
	}
	
	public function findProductMapForCode($string,$categoryIdArray=null,$productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_MAP_CODE;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductMapForCode for String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $productIdMap;
	}
	
	public function findProductSynonnymMapForCode($string, $categoryIdArray=null, $productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_SYN_MAP_CODE;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'ps.Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductSynonnymMapForCode For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			$dbh = null;
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
		}
		return $productIdMap;
	}
	
	public function findProductMapForBrand($string,$categoryIdArray=null,$productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_MAP_BRAND;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductMapForBrand for String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $productIdMap;
	}
	
	public function findProductSynonnymMapForBrand($string, $categoryIdArray=null, $productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_SYN_MAP_BRAND;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'ps.Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductSynonnymMapForBrand For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			$dbh = null;
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
		}
		return $productIdMap;
	}
	
	public function findProductMapForSubBrand($string,$categoryIdArray=null,$productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_MAP_SUB_BRAND;
		$productIdMap = null;
		//$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductMapForSubBrand for String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $productIdMap;
	}
	
	public function findProductSynonnymMapForSubBrand($string, $categoryIdArray=null, $productCategoryMapIdAddary = null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_PROD_SYN_MAP_SUB_BRAND;
		$productIdMap = null;
		$input = '%'.$string.'%';
		try {
			$proCatMapSql = $this->formSqlWithInClause($productCategoryMapIdAddary, 'ps.Product_Category_Map_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for findProductSynonnymMapForSubBrand For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $input, PDO::PARAM_STR);
			$start = 2;
			$arr = $this->setBindVariablesFromObject($start, $productCategoryMapIdAddary, $stmt, 'INT','Product','getProductId');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$productIdMap = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$prodCat = new TaxonomyProductCategory($row->Category_Id, $row->Product_Category_Map_Id);
				array_push($productIdMap, $prodCat);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			$dbh = null;
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
		}
		return $productIdMap;
	}
	
	public function findCategory($string,$categoryIdArray=null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_CATEGORY;
		//$input = '%'.$string.'%';
		$level = 1;
		try {
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for Category For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$stmt->bindParam(2, $level, PDO::PARAM_INT);
			$start = 3;
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$categoryIds = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($categoryIds, $row->Category_Id);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $categoryIds;
	}

	public function findCategorySynonym($string,$categoryIdArray=null) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_TAXONOMY_CATEGORY_SYN;
		//$input = '%'.$string.'%';
		$level = 1;
		try {
			$proCatMapSql = $this->formSqlWithInClause($categoryIdArray, 'Category_Id');
			if(null != $proCatMapSql) {
				$sql = $sql." and ".$proCatMapSql;
			}
			$this->logger->debug("Sql for Category Synonym For String:: ".$sql." ".$string);
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $string, PDO::PARAM_STR);
			$stmt->bindParam(2, $level, PDO::PARAM_INT);
			$start = 3;
			$arr = $this->setBindVariables($start, $categoryIdArray, $stmt, 'INT');
			if(null != $arr) {
				$stmt = $arr[0];
				$start = $arr[1];
			}
			$stmt->execute();
			$categoryIds = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				array_push($categoryIds, $row->Category_Id);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $categoryIds;
	}

	public function findAllNotificationWithCategory() {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_NOTIFICATION_CAT;
		$notificationArray = null;
		$this->logger->debug("Sql for findAllNotificationWithCategory:: ".$sql);
		try {
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->execute();
			$notificationArray = array();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$notification = new NotificationDto();
				$notification->setId($row->id);
				$notification->setKeywords($row->keywords);
				$notification->setEmail($row->emailaddress);
				$notification->setMobileNumber($row->mobilenumber);
				$notification->setCatIds($row->category_id);
				$notification->setProdIds($row->product_category_map_id);
				array_push($notificationArray, $notification);
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $notificationArray;
	}
	public function findParentCategory($childCategoryId) {
		$dbh = null;
		$sql = BatchSQLQueryConstant::SQL_PARENT_CATEGORY;
		$parentCategoryId = null;
		$this->logger->debug("Sql for findParentCategory:: ".$sql);
		try {
			$dbh = $this->formConnection();
			$stmt = $dbh->prepare($sql);
			$stmt->bindParam(1, $childCategoryId, PDO::PARAM_INT);
			$stmt->execute();
			while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
				$parentCategoryId = $row->category_id;
			}
			$dbh = null;
		} catch (PDOException $e) {
			$this->logger->error("Error While getting findProductMap Taxonomy Match:: ".$e->getMessage());
			throw new InternalException($e->getMessage(), $e->getCode(), $e);
			$dbh = null;
		}
		return $parentCategoryId;
	}
}
?>