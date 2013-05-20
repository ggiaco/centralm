<?php

class Polcode_Productmessage_Block_Adminhtml_Productmessage_Show extends Mage_Adminhtml_Block_Abstract{

	public $_model;
	private $_product;
	private $arrCategories = array();

	public function __construct(){
		parent::__construct();
		$this->setTemplate('productmessage/show.phtml');

		$modelId = $this->getRequest()->getParam('id');

		$this->_model = Mage::getModel('productmessage/productmessage')->load($modelId);

		$this->_product = Mage::getModel('catalog/product')->load($this->_model->getProductId());

		$this->_getCategories();
	}

	public function getModel(){
		return $this->_model;
	}

	public function getProduct(){
		return $this->_product;
	}

	private function _getCategories(){
		$categoryIds = $this->_product->getCategoryIds();

		foreach($categoryIds as $categoryId) {
		    $category = Mage::getModel('catalog/category')->load($categoryId);
		    $this->arrCategories[] = $category->getName();
		}
	}

	public function getCategories(){
		return $this->arrCategories;
	}

}