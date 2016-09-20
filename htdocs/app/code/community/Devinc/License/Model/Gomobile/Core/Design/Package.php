<?php

class Devinc_License_Model_Gomobile_Core_Design_Package extends Mage_Core_Model_Design_Package
{
    /**
     * Set package name
     * In case of any problem, the default will be set.
     *
     * @param  string $name
     * @return Mage_Core_Model_Design_Package
     */
    public function getPackageName()
    {
		if(Mage::getDesign()->getArea() == 'adminhtml') {
			return parent::getPackageName();
		} else {
			$enabled = false;
			$isModuleEnabled = Mage::getStoreConfig('advanced/modules_disable_output/Devinc_Gomobile');
			$isEnabled = Mage::getStoreConfig('gomobile/configuration/enabled');
			if ($isModuleEnabled == 0 && $isEnabled == 1 && in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) $enabled = true;
			
			if ($enabled && (Mage::getSingleton("customer/session")->getSwitchTo()=='mobile' || (Mage::getSingleton("customer/session")->getSwitchTo()!='desktop' && Mage::getModel('license/module')->isMobile()))) {	
				return 'gomobile';
			} else {                  
				return parent::getPackageName();
			}
		}
    }    

    /**
     * Declare design package theme params
     * Polymorph method:
     * 1) if 1 parameter specified, sets everything to this value
     * 2) if 2 parameters, treats 1st as key and 2nd as value
     *
     * @return Mage_Core_Model_Design_Package
     */
    public function getTheme($type)
    {
		if(Mage::getDesign()->getArea() == 'adminhtml') {
			return parent::getTheme($type);
		} else {
			$enabled = false;
			$isModuleEnabled = Mage::getStoreConfig('advanced/modules_disable_output/Devinc_Gomobile');
			$isEnabled = Mage::getStoreConfig('gomobile/configuration/enabled');
			if ($isModuleEnabled == 0 && $isEnabled == 1 && in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) $enabled = true;
			
			if ($enabled && (Mage::getSingleton("customer/session")->getSwitchTo()=='mobile' || (Mage::getSingleton("customer/session")->getSwitchTo()!='desktop' && Mage::getModel('license/module')->isMobile()))) {	
				return 'default';
			} else {                  
				return parent::getTheme($type);
			}
		}
    }

}