<?php
class Webizmu_Dropshipper_Model_Styles
{
    public function toOptionArray()
    {
        return array(
            array('value'=>1, 'label'=>Mage::helper('dropshipper')->__('Red')),
            array('value'=>2, 'label'=>Mage::helper('dropshipper')->__('Blue')),
                           
        );
    }
}


