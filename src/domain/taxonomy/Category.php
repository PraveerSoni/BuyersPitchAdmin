<?php
require_once ("../domain/taxonomy/Product.php");
class Category {

	private $categoryId;

	private $productIds;

	private $categoryName;

	public function __construct($catId) {
		$this->categoryId = $catId;
	}

	public function getCategoryId() {
		return $this->categoryId;
	}

	public function setCategoryName($catName) {
		$this->categoryName = $catName;
	}

	public function getCategoryName() {
		return $this->categoryName;
	}

	public function setProductIds($prodId) {
		$this->productIds = $this->getProductIds();
		$cnt = count($this->productIds);
		for($i = 0; $i < $cnt; $i++) {
			if($this->productIds[$i]->getProductId() == $prodId) {
				return;
			}
		}
		$product = new Product($prodId);
		array_push($this->productIds, $product);
	}

	public function setProductIdArray($prodIdArray) {
		$this->productIds = $this->getProductIds();
		$cnt = count($this->productIds);
		for($i = 0; $i < $cnt; $i++) {
			if($this->productIds[$i]->getProductId() == $prodId) {
				return;
			}
		}
		$product = new Product($prodId);
		array_push($this->productIds, $product);
	}

	public function getProductIds() {
		if(null == $this->productIds && !isset($this->productIds) && !is_array($this->productIds)) {
			$this->productIds = array();
		}
		return $this->productIds;
	}

	public function __toString() {
		$string = "Category { ";
		$string = $string."CategoryId = ".$this->categoryId;
		if(null != $this->productIds) {
			for($i = 0; $i < count($this->productIds); $i++) {
				$string=$string."[productIds[".$i."]=".$this->productIds[$i]."]";
			}
		}
		$string = $string." }";
		return $string;
	}

	public function addProduct(Product $product) {
		$this->productIds = $this->getProductIds();
		$cnt = count($this->productIds);
		for($i = 0; $i < $cnt; $i++) {
			if($this->productIds[$i]->getProductId() == $product->getProductId()) {
				return;
			}
		}
		//$product = new Product($product);
		array_push($this->productIds, $product);
	}
}
?>