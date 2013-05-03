<?php
class Webizmu_Dropshipper_Model_Featured
{
    public function toOptionArray()
    {
		return array(
			array('value'=>1, 'label'=>Mage::helper('dropshipper')->__('Yes')),
            array('value'=>2, 'label'=>Mage::helper('dropshipper')->__('No')),
                           
        );
    }
}


