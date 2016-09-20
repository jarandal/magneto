<?php
/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Catalog
 * @copyright   Copyright (c) 2012 Magento Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


/**
 * Catalog navigation
 *
 * @category   Mage
 * @package    Mage_Catalog
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Devinc_License_Block_Gomobile_Catalog_Navigation extends Mage_Catalog_Block_Navigation
{
    
    public function renderCategoriesMenuHtml($level = 0, $outermostItemClass = '', $childrenWrapClass = '', $homePage = true)
    {
        $activeCategories = array();
        foreach ($this->getStoreCategories() as $child) {
            if ($child->getIsActive()) {
                $activeCategories[] = $child;
            }
        }
        $activeCategoriesCount = count($activeCategories);
        $hasActiveCategoriesCount = ($activeCategoriesCount > 0);

        if (!$hasActiveCategoriesCount) {
            return '';
        }

        $html = '';
        $j = 0;
        foreach ($activeCategories as $category) {
            $html .= $this->_renderCategoryMenuItemHtml(
                $category,
                $level,
                ($j == $activeCategoriesCount - 1),
                ($j == 0),
                true,
                $outermostItemClass,
                $childrenWrapClass,
                true
            );
            $j++;
            if (!$homePage && $j%3 == 0) $html .= '<br />';
        }
        
        if (!$homePage) {
            //add blank elements
            if ($j%3 == 2) {
                $html .= '<li class="blank"></li>';
            } else if($j%3 == 1){
                $html .= '<li class="blank"></li><li class="blank"></li>';
            }
        }

        return $html;
    }

    protected function _renderCategoryMenuItemHtml($category, $level = 0, $isLast = false, $isFirst = false, $isOutermost = false, $outermostItemClass = '', $childrenWrapClass = '', $noEventAttributes = false)
    {
        $storeId = Mage::app()->getStore()->getId();        
        $isModuleEnabled = Mage::getStoreConfig('advanced/modules_disable_output/Devinc_Gomobile', $storeId);
        $isEnabled = Mage::getStoreConfig('gomobile/configuration/enabled', $storeId);
        
        if ($isModuleEnabled != 0 && $isEnabled != 1 && !in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) {    
            return '';
        }
        
        if (!$category->getIsActive()) {
            return '';
        }
        $html = array();

        // get all children
        if (Mage::helper('catalog/category_flat')->isEnabled()) {
            $children = (array)$category->getChildrenNodes();
            $childrenCount = count($children);
        } else {
            $children = $category->getChildren();
            $childrenCount = $children->count();
        }
        $hasChildren = ($children && $childrenCount);

        // select active children
        $activeChildren = array();
        foreach ($children as $child) {
            if ($child->getIsActive()) {
                $activeChildren[] = $child;
            }
        }
        $activeChildrenCount = count($activeChildren);
        $hasActiveChildren = ($activeChildrenCount > 0);

        // prepare list item html classes
        $classes = array();
        $classes[] = 'level' . $level;
        $classes[] = 'nav-' . $this->_getItemPosition($level);
        // if ($this->isCategoryActive($category)) {
        //     $classes[] = 'active';
        // }
        $linkClass = '';
        if ($isOutermost && $outermostItemClass) {
            $classes[] = $outermostItemClass;
            $linkClass = ' class="'.$outermostItemClass.'"';
        }
        if ($isFirst) {
            $classes[] = 'first';
        }
        if ($isLast) {
            $classes[] = 'last';
        }
        if ($hasActiveChildren) {
            $classes[] = 'parent';
        }

        // prepare list item attributes
        $attributes = array();
        if (count($classes) > 0) {
            $attributes['class'] = implode(' ', $classes);
        }
        if ($hasActiveChildren && !$noEventAttributes) {
             $attributes['onmouseover'] = 'toggleMenu(this,1)';
             $attributes['onmouseout'] = 'toggleMenu(this,0)';
        }
        
        $htmlLi = '<li';
        foreach ($attributes as $attrName => $attrValue) {
            if ($attrName=='class') {
                $htmlLi .= ' ' . $attrName . '="' . str_replace('"', '\"', $attrValue) . '"';
            } else {
                $htmlLi .= ' ' . $attrName . '="' . str_replace('"', '\"', $attrValue) . '"';
            }
        }
        $htmlLi .= '>';
        
        $html[] = $htmlLi;
        
        //disable ajax loading for categories that have subcategories
        $_useAjax = '';
        if ($hasActiveChildren){
            $_useAjax = 'data-ajax="false"';
        }
        
        $html[] = '<a '.$_useAjax.' href="'.$this->getCategoryUrl($category).'"'.$linkClass.'>';
        if ($thumbnail = $this->getThumbnailUrl($category->getId())) {
            $html[] = '<div class="cat-img"><img class="img" src="' . $thumbnail . '" alt="" /></div>';
        }
        $html[] = '<span>' . $this->escapeHtml($category->getName()) . '</span>';
        $html[] = '</a>';

        // render children
        $htmlChildren = '';
        $j = 1;
        foreach ($activeChildren as $child) {
            if ($j==1) {                
                $htmlChildren .= '<li class="level1 first all-products"><a href="'.$this->getCategoryUrl($category).'" class="ui-link"><div class="cat-img"><img class="img" src="' . $thumbnail . '" alt="" /></div><span>All Products</span></a></li>';
            }
            $htmlChildren .= $this->_renderCategoryMenuItemHtml(
                $child,
                ($level + 1),
                ($j%3 == 2),
                ($j%3 == 0),
                false,
                $outermostItemClass,
                $childrenWrapClass,
                $noEventAttributes
            );
            $j++;  
            if ($j%3 == 0) $htmlChildren .= '<br />';
        }
        if (!empty($htmlChildren)) {        
            //add blank elements if needed
            $blankElements = '';
            if ($j%3 == 2) {
                $blankElements = '<li class="blank"></li>';
            } else if($j%3 == 1){
                $blankElements = '<li class="blank"></li><li class="blank"></li>';
            }
            
            if ($childrenWrapClass) {
                $html[] = '<div class="' . $childrenWrapClass . '">';
            }
            $html[] = '<ul class="level' . $level . '">';
            $html[] = $htmlChildren.$blankElements;                     
        
            
            $html[] = '</ul>';
            if ($childrenWrapClass) {
                $html[] = '</div>';
            }
        }

        $html[] = '</li>';        

        $html = implode("\n", $html);
        return $html;
    }
    
    public function getThumbnailUrl($_categoryId)
    {
        $category = Mage::getModel('catalog/category')->getCollection()->addAttributeToFilter('entity_id', $_categoryId)->addAttributeToSelect('thumbnail')->getFirstItem();
        
        $url = false;
        if ($thumbnail = $category->getThumbnail()) {
            $url = Mage::getBaseUrl('media').'catalog/category/'.$thumbnail;
        }
        return $url;
    }
    
}