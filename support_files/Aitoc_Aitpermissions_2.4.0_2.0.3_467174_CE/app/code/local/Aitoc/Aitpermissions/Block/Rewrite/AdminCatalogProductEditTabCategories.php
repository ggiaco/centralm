<?php
/**
 * Product:     Advanced Permissions
 * Package:     Aitoc_Aitpermissions_2.4.0_2.0.3_467174
 * Purchase ID: 3G9mNSuToHcGAqzlcnyFlyU7YfL60ELq65IlLBrb3G
 * Generated:   2013-05-03 18:29:40
 * File path:   app/code/local/Aitoc/Aitpermissions/Block/Rewrite/AdminCatalogProductEditTabCategories.php
 * Copyright:   (c) 2013 AITOC, Inc.
 */
?>
<?php if(Aitoc_Aitsys_Abstract_Service::initSource(__FILE__,'Aitoc_Aitpermissions')){ kpZqgMZBeekZeamc('3ba71c9dee18c577a10bb691c6efb4df'); ?><?php

/**
* @copyright  Copyright (c) 2012 AITOC, Inc.
*/

class Aitoc_Aitpermissions_Block_Rewrite_AdminCatalogProductEditTabCategories
    extends Mage_Adminhtml_Block_Catalog_Product_Edit_Tab_Categories
{
    public function getCategoryCollection()
    {
        $collection = parent::getCategoryCollection();

        $role = Mage::getSingleton('aitpermissions/role');

        if ($role->isPermissionsEnabled())
        {
            if ($role->isScopeStore())
            {
                $collection->addIdFilter($role->getCategoryIdsFromAllowedStores());
            }

            if ($role->isScopeWebsite())
            {
                $collection->addIdFilter($role->getAllowedCategoryIds());
            }

            $this->setData('category_collection', $collection);
        }

        return $collection;
    }

    public function isReadonly($id = 0)
    {
        $role = Mage::getSingleton('aitpermissions/role');

        if (!$role->isScopeStore())
        {
            return $this->getProduct()->getCategoriesReadonly();
        }

        $categoryAllowed = in_array($id, $role->getAllowedCategoryIds());
        $categoriesReadOnly = $this->getProduct()->getCategoriesReadonly();

        if ($categoryAllowed && !$categoriesReadOnly)
        {
            return false;
        }

        return true;
    }


    protected function _getNodeJson($node, $level=1)
    {
        $item = parent::_getNodeJson($node, $level);

        $isParent = $this->_isParentSelectedCategory($node);

        if ($isParent)
        {
            $item['expanded'] = true;
        }

        if (in_array($node->getId(), $this->getCategoryIds()))
        {
            $item['checked'] = true;
        }

        if (!$this->isReadonly($node->getId()))
        {
            $item['disabled'] = false;
        }
        
        return $item;
    }


    public function getRoot($parentNodeCategory=null, $recursionLevel=3)
    {
        if (!is_null($parentNodeCategory) && $parentNodeCategory->getId())
        {
            return $this->getNode($parentNodeCategory, $recursionLevel);
        }
        $root = Mage::registry('root');
        if (is_null($root))
        {
            $storeId = (int)$this->getRequest()->getParam('store');

            if ($storeId)
            {
                $store = Mage::app()->getStore($storeId);
                $rootId = $store->getRootCategoryId();
            }
            else
            {
                $rootId = Mage_Catalog_Model_Category::TREE_ROOT_ID;
            }

            $ids = $this->getSelectedCategoriesPathIds($rootId);
            $tree = Mage::getResourceSingleton('catalog/category_tree')
                ->loadByIds($ids, false, false);

            if ($this->getCategory())
            {
                $tree->loadEnsuredNodes($this->getCategory(), $tree->getNodeById($rootId));
            }

            $tree->addCollectionData($this->getCategoryCollection());

            $root = $tree->getNodeById($rootId);

            if ($root && $rootId != Mage_Catalog_Model_Category::TREE_ROOT_ID)
            {
                $root->setIsVisible(true);
                if ($this->isReadonly($rootId))
                {
                    $root->setDisabled(true);
                }
            }
            elseif ($root && $root->getId() == Mage_Catalog_Model_Category::TREE_ROOT_ID)
            {
                $root->setName(Mage::helper('catalog')->__('Root'));
            }

            Mage::register('root', $root);
        }

        return $root;
    }
    
    protected function _getSelectedNodes()
    {
        if (version_compare(Mage::getVersion(), '1.4.0.0', '>='))
        {
            return parent::_getSelectedNodes();
        }

        if ($this->_selectedNodes === null)
        {
            $this->_selectedNodes = array();
            $root = $this->getRoot();

            foreach ($this->getCategoryIds() as $categoryId)
            {
                if ($root)
                {
                    $this->_selectedNodes[] = $this->getRoot()->getTree()->getNodeById($categoryId);
                }
            }
        }

        return $this->_selectedNodes;
    }
} } 