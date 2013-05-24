<?php

class Polcode_Productmessage_Block_Adminhtml_Productmessage_Grid extends Mage_Adminhtml_Block_Widget_Grid{

	public function __construct(){
		parent::__construct();	
		$this->setId('ProductmessageGrid');
		$this->setDefaultSort('productmessage_id');
		$this->setDefaultDir('ASC');
		//$this->saveParametersInSession(true);
		$this->setUseAjax(true);
	}

	protected function _prepareCollection(){
		$collection = Mage::getModel('productmessage/productmessage')->getCollection();
		$this->setCollection($collection);
		return parent::_prepareCollection();
	}

	protected function _prepareColumns(){

		$this->addColumn('productmessage_id' , array(
			'header' => Mage::helper('productmessage')->__('ID'),
			'align'	 => 'right',
			'width'  => '50px',
			'index'  => 'productmessage_id',
		));

		$this->addColumn('product_name' , array(
			'header' => Mage::helper('productmessage')->__('Product'),
			'align'	 => 'left',
			'width'  => '200px',
			'index'  => 'product_name',
		));

		$this->addColumn('name' , array(
			'header' => Mage::helper('productmessage')->__('Nombre'),
			'align'	 => 'left',
			'index'  => 'name',
		));
		
		$this->addColumn('email' , array(
			'header' => Mage::helper('productmessage')->__('Phone'),
			'align'	 => 'left',
			'index'  => 'phone',
		));
		
		$this->addColumn('email' , array(
			'header' => Mage::helper('productmessage')->__('Email'),
			'align'	 => 'left',
			'index'  => 'email',
		));

		$this->addColumn('create_time' , array(
			'header' => Mage::helper('productmessage')->__('Creado'),
			'align'	 => 'left',
			'index'  => 'create_time',
		));

		$this->addColumn('message' , array(
			'header' => Mage::helper('productmessage')->__('Mensaje'),
			'align'	 => 'left',
			'width'  => '200px',
			'index'  => 'message',
		));

		return parent::_prepareColumns();
	}

	public function getGridUrl()
	{
		return $this->getUrl('*/*/grid', array('_current'=>true));
	}

	public function getRowUrl($row)
    {
    	return $this->getUrl('*/*/show', array('id' => $row->getId()));
    }

	public function setSaveParametersInSession($flag)
    {
    	return $this;
    	return parent::setSaveParametersInSession($flag);
    }

}