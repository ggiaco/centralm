<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminSalesOrderCreateStoreSelect.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ MCkcjekDZZMkZyBT('35911c49ac20870d6165f325614026c5'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminSalesOrderCreateStoreSelect
    extends Mage_Adminhtml_Block_Sales_Order_Create_Store_Select
{
    public function getStoreCollection($group)
    {
        $stores = parent::getStoreCollection($group);

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
        	$stores->addIdFilter($role->getAllowedStoreviewIds());
        }

        return $stores;
    }
} } 