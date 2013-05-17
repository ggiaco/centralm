<?php

class Polcode_Productmessage_Block_Adminhtml_Productmessage extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct(){
		$this->controller = 'adminhtml_productmessage';
		$this->blockGrou = 'productmessage';
		$this->headerText = Mage::helper('productmessage')->__('Product message manager');
		parent::__construct();
	}
}