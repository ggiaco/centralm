<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminhtmlCatalogProductEditTabInventory.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ mhrCeBrjDDmrDkgU('2d63a09ace03fcbf32415ddaaa12f8e6'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminhtmlCatalogProductEditTabInventory
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Inventory
{
    protected function _toHtml()
    {
        $role = Mage::getSingleton('aitpermissions/role');

        if (!$role->isPermissionsEnabled() || $role->canEditGlobalAttributes())
        {
            return parent::_toHtml();
        }

        return parent::_toHtml() . '
            <input id="aitpermissions_inventory_manage_stock_default" name="product[stock_data][use_config_manage_stock]" type="hidden" value="1" />
            <script type="text/javascript">
            //<![CDATA[
            if (Prototype.Browser.IE)
            {
                if (window.addEventListener)
                {
                    window.addEventListener("load", disableInventoryInputs, false);
                }
                else
                {
                    window.attachEvent("onload", disableInventoryInputs);
                }
            }
            else
            {
                document.observe("dom:loaded", disableInventoryInputs);
            }

            function disableInventoryInputs()
            {
                var elements = $("table_cataloginventory").select(\'input[type="checkbox"],input[type="text"],select\');
                if (elements.size)
                {
                    elements.each(function(el) {
                       el.disabled = true;
                    });
                }

                if(typeof($("inventory_use_config_manage_stock")) != "undefined");
                {
                    if($("inventory_use_config_manage_stock").checked)
                    {
                        $("aitpermissions_inventory_manage_stock_default").value = 1;
                    }
                    else
                    {
                        $("aitpermissions_inventory_manage_stock_default").value = 0;
                    }
                }
            }
            //]]>
            </script>';
    }
} } 