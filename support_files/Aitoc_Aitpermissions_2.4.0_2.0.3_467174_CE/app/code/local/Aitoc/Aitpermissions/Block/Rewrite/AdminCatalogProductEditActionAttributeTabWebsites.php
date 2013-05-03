<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCatalogProductEditActionAttributeTabWebsites.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ ZQdNEkePWWZeMjrX('f9f2143370fc885d9acda9f0597bf495'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCatalogProductEditActionAttributeTabWebsites
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Action_Attribute_Tab_Websites
{
    public function getWebsiteCollection()
    {
        $websites = parent::getWebsiteCollection();

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
        	foreach ($websites as $key => $website)
            {
            	if (!in_array($website->getId(), $role->getAllowedWebsiteIds()))
            	{
            		unset($websites[$key]);
            	}
            }
        }
        
        return $websites;
    }
} } 