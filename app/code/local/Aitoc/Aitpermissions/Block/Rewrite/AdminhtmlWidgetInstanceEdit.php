<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminhtmlWidgetInstanceEdit.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ MCkcjekDZZMkZyBT('fd7f1ae63df655243fd35b0aba0b27e9'); ?><?php
class Aitoc_Aitpermissions_Block_Rewrite_AdminhtmlWidgetInstanceEdit
    extends Mage_Widget_Block_Adminhtml_Widget_Instance_Edit
{
    protected function _preparelayout()
    {
        parent::_prepareLayout();

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
            $widgetInstance = Mage::registry('current_widget_instance');

            // checking if we have permissions to edit this widget
            if ($widgetInstance->getId() &&
                is_array($widgetInstance->getStoreIds()) &&
                !array_intersect($widgetInstance->getStoreIds(), $role->getAllowedStoreviewIds()))
            {
                Mage::app()->getResponse()->setRedirect(Mage::getUrl('*/*'));
            }

            if (!$widgetInstance->getStoreIds() ||
                array_diff($widgetInstance->getStoreIds(), $role->getAllowedStoreviewIds()))
            {
                $this->_removeButton('delete');
            }
        }
        
        return $this;
    }
} } 