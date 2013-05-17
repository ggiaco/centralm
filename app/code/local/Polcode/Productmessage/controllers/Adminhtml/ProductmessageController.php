<?php


class Polcode_Productmessage_Adminhtml_ProductmessageController extends Mage_Adminhtml_Controller_Action{

	public function indexAction(){
		$this->_addContent($this->getLayout->createblock('productmessage/adminhtml_productmessage'));
		$this->renderLayout();
	}

	public function gridAction(){
		$this->loadLayout();
		$this->getResponse()->setBody($this->getLayout->createblock('productmessage/adminhtml_productmessage_grid')->toHtml());
	}

}