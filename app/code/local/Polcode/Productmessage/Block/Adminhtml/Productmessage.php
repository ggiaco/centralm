<?php
/**
 * Admin Block responsible for setting grid
 * 
 *  @author  Jakub Korupczyński <jakub.korupczynski@polcode.pl>
 */
class Polcode_Productmessage_Block_Adminhtml_Productmessage extends Mage_Adminhtml_Block_Widget_Grid_Container{

	public function __construct(){
		$this->_controller = 'adminhtml_productmessage';
		$this->_blockGroup = 'productmessage';
		$this->_headerText = Mage::helper('productmessage')->__('Product message manager');
		parent::__construct();
		$this->_removeButton('add');
	}
}