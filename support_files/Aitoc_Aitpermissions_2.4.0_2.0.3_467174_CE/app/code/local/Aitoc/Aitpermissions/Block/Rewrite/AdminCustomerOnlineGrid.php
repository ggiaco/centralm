<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCustomerOnlineGrid.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ ZQdNEkePWWZeMjrX('53d8507255e86b2abfc6937d4daeb736'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCustomerOnlineGrid extends Mage_Adminhtml_Block_Customer_Online_Grid
{
    protected function _prepareCollection()
    {
        /* @var $collection Mage_Log_Model_Mysql4_Visitor_Online_Collection */
        $collection = Mage::getModel('log/visitor_online')
            ->prepare()
            ->getCollection();
        
        $collection->addCustomerData();
        
        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
            $collection->getSelect()->where(
                '`customer_email`.website_id IN (' . implode(',', $role->getAllowedWebsiteIds()) . ')'
            );
        }

        $this->setCollection($collection);
        Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
        
        return $this;
    }
} } 