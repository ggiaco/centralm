<?php
/**
 * Form block - It displays Product message block.
 *
 * @author  Jakub Korupczyński <jakub.korupczynski@polcode.pl>
 */
class Polcode_Productmessage_Block_Form extends Mage_Core_Block_Template{

	/**
	 * Current category object
	 * @var Mage_Core_Category_Model
	 */
	private $_category = false;

	/**
	 * Setting $_category variable and starting parent constructor
	 */
	public function __construct(){
		$this->_category = Mage::registry('current_category');
		parent::__construct();
	}

	/**
	 * Returning current main category
	 * @return string Category name
	 */
	public function getCategory(){
		if ($this->_category && $this->_category->getId()){
			$parentCategory = Mage::getModel('catalog/category')->load($this->_category->getParentId());
			if ($parentCategory->getId()){
				return $parentCategory->getName();
			}
		}
		return '';
	}

	/**
	 * Get Current subcategory
	 * @return string Category name
	 */
	public function getSubCategory(){
		if ($this->_category && $this->_category->getId()){
			return $this->_category->getName();
		}
		return '';
	}
}