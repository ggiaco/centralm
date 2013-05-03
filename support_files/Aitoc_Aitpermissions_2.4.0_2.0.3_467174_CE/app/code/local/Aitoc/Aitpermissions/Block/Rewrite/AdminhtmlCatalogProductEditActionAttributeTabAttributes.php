<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminhtmlCatalogProductEditActionAttributeTabAttributes.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ DRVQkrBEPPDBmeaA('c5c2f7ee96bdb004f5a14bf1e7623e63'); ?><?php
/**
* @copyright  Copyright (c) 2011 AITOC, Inc. 
*/
class Aitoc_Aitpermissions_Block_Rewrite_AdminhtmlCatalogProductEditActionAttributeTabAttributes
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Action_Attribute_Tab_Attributes
{
    protected function _getAdditionalElementHtml($element)
    {
        $result = parent::_getAdditionalElementHtml($element);

        if ($element &&
            $element->getEntityAttribute() &&
            $element->getEntityAttribute()->isScopeGlobal())
        {
            $role = Mage::getSingleton('aitpermissions/role');

            if ($role->isPermissionsEnabled() && !$role->canEditGlobalAttributes())
            {
                $result = str_replace('<input type="checkbox"', '<input type="checkbox" disabled="disabled"', $result);
            }
        }
        
        return $result;
    }
} } 