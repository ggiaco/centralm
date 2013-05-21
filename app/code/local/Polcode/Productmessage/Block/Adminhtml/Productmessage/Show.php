<?php

class Polcode_Productmessage_Block_Adminhtml_Productmessage_Show extends Mage_Adminhtml_Block_Widget_View_Container{

	public $_model;
	private $_product;
	private $arrCategories = array();

	public function __construct(){
		parent::__construct();
		$this->_removeButton('edit');
		
		$this->setTemplate('productmessage/show.phtml');

		$this->_prepareModels();

		$this->_headerText = Mage::helper('productmessage')->__('Message view');
	}

	public function _prepareModels(){
		$modelId = $this->getRequest()->getParam('id');

		$this->_model = Mage::getModel('productmessage/productmessage')->load($modelId);

		$this->_product = Mage::getModel('catalog/product')->load($this->_model->getProductId());
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