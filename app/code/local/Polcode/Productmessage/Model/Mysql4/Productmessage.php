<?php

class Polcode_Productmessage_Model_Mysql4_Productmessage extends Mage_Core_Model_Mysql4_Abstract{
	
	public function _construct(){
		//parent::_construct();
		$this->_init('productmessage/productmessage','productmessage_id');
	}
}