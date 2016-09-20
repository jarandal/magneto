<?php
class Devinc_Groupdeals_Block_Adminhtml_Merchants_Store_Switcher extends Mage_Adminhtml_Block_Store_Switcher
{
    public function getWebsites()
    {
        $websites = Mage::app()->getWebsites();
        
        return $websites;
    }
}