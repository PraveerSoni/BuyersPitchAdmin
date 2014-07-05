<?php
require_once ("../domain/taxonomy/Taxanomy.php");
class Taxanomys {
	private $taxanomys;
	
	public function setTaxanomys($taxanomyArray) {
		$this->taxanomys = $taxanomyArray;
	}
	
	public function getTaxanomys() {
		return $this->taxanomys;
	} 
}