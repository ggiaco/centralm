<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminPermissionsEditroles.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ BIPUZDmarrBmrMjQ('c2c94ed552b03c3e692b831395907ee7'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminPermissionsEditroles extends Mage_Adminhtml_Block_Permissions_Editroles
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        
        $id = $this->getRequest()->getParam('rid');
		$storeCategories = Mage::getResourceModel('aitpermissions/advancedrole_collection')->loadByRoleId($id);
		Mage::register('store_categories', $storeCategories);
        
        $this->addTab('advanced', array(
            'label'     => Mage::helper('aitpermissions')->__('Advanced Permissions'),
            'content' => $this->getLayout()->createBlock('aitpermissions/adminhtml_permissions_tab_advanced')->toHtml()           
        ));

        return $this;
    }
} } 