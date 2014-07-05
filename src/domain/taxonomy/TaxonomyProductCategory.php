<?php
require_once ("../domain/taxonomy/Category.php");
class TaxonomyProductCategory {

	private $categoryId;

	private $categoryName;

	private $productId;

	private $productCode;

	private $productBrand;

	private $productSubBrand;

	private $productName;

	private $logger;

	public function __construct($catId, $prodId) {
		$this->categoryId = $catId;
		$this->productId = $prodId;
		$this->logger = BatchUtil::getBatchLogger('TaxonomyProductCategory');
	}

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setCategoryName($catName) {
		$this->categoryName = $catName;
	}

	public function getCategoryName() {
		return $this->categoryName;
	}

	public function setProductCode($prodCode) {
		$this->productCode = $prodCode;
	}

	public function getProductCode() {
		return $this->productCode;
	}

	private function checkAndFormCategory($categorys) {
		$iLen = count($categorys);
		$this->logger->debug("Count:: ".$iLen);
		$category = null;
		foreach($categorys as $catKey=>$catValue) {
			//for($i = 0; $i < $iLen; $i++) {
			if($catValue->getCategoryId() == $this->categoryId) {
				//if($categorys[$i]->getCategoryId() == $this->categoryId) {
				$category = $catValue;
				$category->setProductIds($this->productId);
				//array_splice($categorys, $i, 1);
				unset($categorys[$catKey]);
				break;
			}
		}
		$iLen = count($categorys);
		$this->logger->debug("Count111:: ".$iLen);
		if(null == $category) {
			$category = new Category($this->categoryId);
			$category->setProductIds($this->productId);
		}
		$this->logger->debug("Category To Push:: ".$category);
		array_push($categorys, $category);
		$iLen = count($categorys);
		$this->logger->debug("Count After Push:: ".$iLen);
		return $categorys;
	}

	public function formCategoriesFromProductCategory($categorys) {
		if(null == $categorys && !isset($categorys) && !is_array($categorys)) {
			$categorys = array();
		}
		$categorys = $this->checkAndFormCategory($categorys);
		return $categorys;
	}
	
	public function formCategoryUsingData(Category $category) {
		$product = new Product($this->productId);
		$product->setProductBrand($this->productBrand);
		$product->setProductCode($this->productCode);
		$product->setProductName($this->productName);
		$product->setProductSubBrand($this->productSubBrand);
		$category->addProduct($product);
		return $category;
	}
	
	public function getProductBrand()
	{
		return $this->productBrand;
	}

	public function setProductBrand($productBrand)
	{
		$this->productBrand = $productBrand;
	}

	public function getProductSubBrand()
	{
		return $this->productSubBrand;
	}

	public function setProductSubBrand($productSubBrand)
	{
		$this->productSubBrand = $productSubBrand;
	}

	public function getProductName()
	{
		return $this->productName;
	}

	public function setProductName($productName)
	{
		$this->productName = $productName;
	}
}
?>