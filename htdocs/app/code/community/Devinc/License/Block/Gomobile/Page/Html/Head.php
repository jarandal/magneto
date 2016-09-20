<?php

class Devinc_License_Block_Gomobile_Page_Html_Head extends Mage_Page_Block_Html_Head
{
	public function getCssJsHtml() {
    	$storeId = Mage::app()->getStore()->getId();        
		$isModuleEnabled = Mage::getStoreConfig('advanced/modules_disable_output/Devinc_Gomobile', $storeId);
		$isEnabled = Mage::getStoreConfig('gomobile/configuration/enabled', $storeId);
		
		if ($isModuleEnabled == 0 && $isEnabled == 1 && in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) {	  
			$html = '<script type="text/javascript">var _0x40ab=["\x6E\x6F\x43\x6F\x6E\x66\x6C\x69\x63\x74"];</script>';
			$html .= parent::getCssJsHtml();
		
			return $html;
		} else {
			return parent::getCssJsHtml();
		}
	}
}