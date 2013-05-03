<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Model/Rewrite/CatalogModelResourceEavMysql4CategoryTree.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ jTORragkEEjgyBZf('de40c2bed4d65161465e1ee1b429cf9d'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Model_Rewrite_CatalogModelResourceEavMysql4CategoryTree
    extends Mage_Catalog_Model_Resource_Eav_Mysql4_Category_Tree
{
    protected function _updateAnchorProductCount(&$data)
    {
        foreach ($data as $key => $row)
        {
            if (isset($row['is_anchor']) && 0 === (int)$row['is_anchor'])
            {
                $data[$key]['product_count'] = $row['self_product_count'];
            }
        }
    }
} } 