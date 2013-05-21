<?php


class Polcode_Productmessage_Adminhtml_ProductmessageController extends Mage_Adminhtml_Controller_Action{
	
	protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('productmessage/productmessage')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Product message'), Mage::helper('adminhtml')->__('Product message manager'));
        return $this;
    }   

	public function indexAction(){
		$this->_initAction();
		$this->_addContent(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage')
		);
		$this->renderLayout();
	}

	public function gridAction(){
		$this->loadLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage_grid')->toHtml()
		);
	}

	public function showAction(){
		$this->loadLayout();
		$this->_addContent(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage_show')
		);
		$this->renderLayout();	
	}

}