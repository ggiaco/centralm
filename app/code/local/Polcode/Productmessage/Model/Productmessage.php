<?php

class Polcode_Productmessage_Model_Productmessage extends Mage_Core_Model_Abstract{
	
	public function _construct(){
		parent::_construct();
		$this->_init('productmessage/productmessage');
	}
	
}