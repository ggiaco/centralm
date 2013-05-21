<?php
/**
 * Product message controller
 * 
 *  @author  Jakub Korupczyński <jakub.korupczynski@polcode.pl>
 */
class Polcode_Productmessage_Adminhtml_ProductmessageController extends Mage_Adminhtml_Controller_Action{
	
	/**
	 * Setting some basic staff like menu, or breadcrumps
	 * @return Mage_Core_Layout
	 */
	protected function _initAction()
    {
        $this->loadLayout()
            ->_setActiveMenu('productmessage/productmessage')
            ->_addBreadcrumb(Mage::helper('adminhtml')->__('Product message'), Mage::helper('adminhtml')->__('Product message manager'));
        return $this;
    }   

    /**
     * Main action for showing admin block
     * @return void
     */
	public function indexAction(){
		$this->_initAction();
		$this->_addContent(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage')
		);
		$this->renderLayout();
	}

	/**
	 * Displaying grid with ajax
	 * @return void
	 */
	public function gridAction(){
		$this->loadLayout();
		$this->getResponse()->setBody(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage_grid')->toHtml()
		);
	}

	/**
	 * Showing message details
	 * @return void
	 */
	public function showAction(){
		$this->loadLayout();
		$this->_addContent(
			$this->getLayout()->createblock('productmessage/adminhtml_productmessage_show')
		);
		$this->renderLayout();	
	}

}