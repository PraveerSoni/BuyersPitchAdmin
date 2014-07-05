<?php
class Product {

	private $productId;

	private $productCode;

	private $productBrand;

	private $productSubBrand;

	private $productName;

	public function __construct($prodId) {
		$this->productId = $prodId;
	}
	
	public function formProduct(Product $product) {
		$this->productId = $product->getProductId();
		$this->productBrand = $product->getProductBrand();
		$this->productCode = $product->getProductCode();
		$this->productName = $product->getProductName();
		$this->productSubBrand = $product->getProductSubBrand();
	}

	public function getProductId() {
		return $this->productId;
	}

	public function setProductCode($prodCode) {
		$this->productCode =$prodCode;
	}

	public function getProductCode() {
		return $this->productCode;
	}

	public function setProductBrand($prodBrand) {
		$this->productBrand = $prodBrand;
	}

	public function getProductBrand() {
		return $this->productBrand;
	}

	public function setProductSubBrand($prodSubBrand) {
		$this->productSubBrand = $prodSubBrand;
	}

	public function getProductSubBrand() {
		return $this->productSubBrand;
	}
	
	public function setProductName($prodName) {
		$this->productName = $prodName;
	}
	
	public function getProductName() {
		return $this->productName;
	}
	
	public function __toString() {
		$string = "Product { ";
		$string = $string."productId = ".$this->productId;
		$string = $string." }";
		return $string;
	}
}
?>