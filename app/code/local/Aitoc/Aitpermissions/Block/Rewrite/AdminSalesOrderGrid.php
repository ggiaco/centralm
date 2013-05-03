<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminSalesOrderGrid.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ jTORragkEEjgyBZf('4a1e2dfeb0d57b0a72eaee3b169127a2'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminSalesOrderGrid extends Mage_Adminhtml_Block_Sales_Order_Grid
{
	protected function _prepareColumns()
	{
		parent::_prepareColumns();

        $role = Mage::getSingleton('aitpermissions/role');

		if ($role->isPermissionsEnabled())
		{
			$allowedStoreviews = $role->getAllowedStoreviewIds();
    		if (count($allowedStoreviews) <= 1 && isset($this->_columns['store_id']))
            {
                unset($this->_columns['store_id']);
            }
		}
        
		return $this;
	}
} } 