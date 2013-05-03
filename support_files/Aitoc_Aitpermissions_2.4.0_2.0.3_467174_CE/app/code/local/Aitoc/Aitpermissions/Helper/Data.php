<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Helper/Data.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ BIPUZDmarrBmrMjQ('b45186f038b4424df9278c7e41c8e1e5'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Helper_Data extends Mage_Core_Helper_Abstract
{
    public function isShowingAllCustomers()
    {
        return Mage::getStoreConfig('admin/general/showallcustomers');
    }

    public function isAllowedDeletePerWebsite()
    {
        return Mage::getStoreConfig('admin/general/allowdelete_perwebsite');
    }

    public function isAllowedDeletePerStoreview()
    {
        return Mage::getStoreConfig('admin/general/allowdelete');
    }

    /**
     * backward compatibility with Shopping Assistant
     */
    public function getAllowedCategories()
    {
        return Mage::getSingleton('aitpermissions/role')->getAllowedCategoryIds();
    }
} } 