<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCmsPageGrid.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ MCkcjekDZZMkZyBT('6e7e268236d38bb55a5eab75d086f3aa'); ?><?php
class Aitoc_Aitpermissions_Block_Rewrite_AdminCmsPageGrid extends Mage_Adminhtml_Block_Cms_Page_Grid
{
    protected function _prepareCollection()
    {
        $collection = Mage::getModel('cms/page')->getCollection();
        /* @var $collection Mage_Cms_Model_Mysql4_Page_Collection */
        $collection->setFirstStoreFlag(true);

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
            $collection->getSelect()->join(
                array('store_table_permissions' => $collection->getTable('cms/page_store')),
                'main_table.page_id = store_table_permissions.page_id',
                array()
            )
            ->where('store_table_permissions.store_id in (?)', $role->getAllowedStoreviewIds())
            ->group('main_table.page_id');            
        }

        $this->setCollection($collection);

        return Mage_Adminhtml_Block_Widget_Grid::_prepareCollection();
    }
} } 