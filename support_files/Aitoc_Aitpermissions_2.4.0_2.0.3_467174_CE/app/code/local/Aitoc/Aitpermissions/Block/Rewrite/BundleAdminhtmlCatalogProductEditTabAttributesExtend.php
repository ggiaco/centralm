<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/BundleAdminhtmlCatalogProductEditTabAttributesExtend.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ jTORragkEEjgyBZf('64b169cb12defe3222ad70346616213a'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_BundleAdminhtmlCatalogProductEditTabAttributesExtend
    extends Mage_Bundle_Block_Adminhtml_Catalog_Product_Edit_Tab_Attributes_Extend
{
    public function checkFieldDisable()
    {        
        $result = parent::checkFieldDisable();
		$superGlobalAttribute = array('sku','weight');
		$currentProduct = Mage::registry('current_product');
        $bAllow = !$currentProduct || !$currentProduct->getId() || !$currentProduct->getSku();
        
        if ($bAllow && 
            $this->getElement() &&
            $this->getElement()->getEntityAttribute()
            && in_array($this->getElement()->getEntityAttribute()->getAttributeCode(), $superGlobalAttribute))
        {
            return $result;
        }
		
        if ($this->getElement() && 
            $this->getElement()->getEntityAttribute() &&
            $this->getElement()->getEntityAttribute()->isScopeGlobal())
        {          
            $role = Mage::getSingleton('aitpermissions/role');

            if ($role->isPermissionsEnabled() && !$role->canEditGlobalAttributes())
            {                
                $this->getElement()->setDisabled(true);
                $this->getElement()->setReadonly(true);
                $afterHtml = $this->getElement()->getAfterElementHtml();
                if (false !== strpos($afterHtml, 'type="checkbox"'))
                {
                    $afterHtml = str_replace('type="checkbox"', 'type="checkbox" disabled="disabled"', $afterHtml);
                    $this->getElement()->setAfterElementHtml($afterHtml);
                }
            }            
        }
        
        return $result;
    }
} } 