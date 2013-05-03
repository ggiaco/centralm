<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCmsBlockEdit.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ yqahBgaejjyajrMI('0c235e181f91c14c39ed17fc4ea6272e'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCmsBlockEdit extends Mage_Adminhtml_Block_Cms_Block_Edit
{
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
            // if page is not assigned to any store views but permitted, will allow to delete and disable it
            $blockModel = Mage::registry('cms_block');
            if ($blockModel->getStoreId() && is_array($blockModel->getStoreId()))
            {
                foreach ($blockModel->getStoreId() as $blockStoreId)
                {
                    if (!in_array($blockStoreId, $role->getAllowedStoreviewIds()))
                    {
                        $this->_removeButton('delete');
                        break 1;
                    }
                }
            }
        }
        
        return $this;
    }
} } 