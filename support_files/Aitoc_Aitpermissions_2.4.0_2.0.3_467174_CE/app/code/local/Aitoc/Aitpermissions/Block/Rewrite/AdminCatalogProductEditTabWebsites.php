<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCatalogProductEditTabWebsites.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ ZQdNEkePWWZeMjrX('9ad28521ebd13bf340bfef1af1f715ce'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCatalogProductEditTabWebsites
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Websites
{
    public function getWebsiteCollection()
    {
    	$collection = Mage::getModel('core/website')->getResourceCollection();

        $role = Mage::getSingleton('aitpermissions/role');

    	if ($role->isPermissionsEnabled())
        {
            $collection->addIdFilter($role->getAllowedWebsiteIds());
        }
        
        return $collection->load();
    }
} } 