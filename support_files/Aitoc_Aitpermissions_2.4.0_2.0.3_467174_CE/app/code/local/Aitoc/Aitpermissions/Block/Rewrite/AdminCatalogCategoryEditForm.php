<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCatalogCategoryEditForm.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ jTORragkEEjgyBZf('aa4122dde503aa4933db387251e610d9'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCatalogCategoryEditForm
    extends Mage_Adminhtml_Block_Catalog_Category_Edit_Form
{
    public function _prepareLayout()
    {
        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled() && !$role->isAllowedToDelete())
        {
            $category = $this->getCategory()->setIsDeleteable(false);
            Mage::unregister('category');
            Mage::register('category', $category);
        }
        
        return parent::_prepareLayout();
    }
} } 