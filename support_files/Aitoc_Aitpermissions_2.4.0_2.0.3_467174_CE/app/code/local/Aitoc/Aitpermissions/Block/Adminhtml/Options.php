<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Adminhtml/Options.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ gcEIDjyZaagyameR('71f36ae772f1bff97e663ed533effc69'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Adminhtml_Options extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('aitpermissions/options.phtml');
    }

    public function canEditGlobalAttributes()
    {
        return Mage::getModel('aitpermissions/advancedrole')->canEditGlobalAttributes($this->_getRoleId());
    }

    public function canEditOwnProductsOnly()
    {
        return Mage::getModel('aitpermissions/advancedrole')->canEditOwnProductsOnly($this->_getRoleId());
    }

    private function _getRoleId()
    {
        return Mage::app()->getRequest()->getParam('rid');
    }
} } 