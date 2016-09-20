<?php

class Devinc_License_Model_System_Config_Backend_License extends Mage_Core_Model_Config_Data
{    
    public function _beforeSave()
    {        
    	$path = $this->getPath();
    	$pathParts = explode('/', $path);
    	$module = $pathParts[1];
    	
        $domains = Mage::getModel('license/license')->getDomains($module);		
        foreach ($domains as $domain) {
        	$origValues[$domain] = '';
        }           
		
		$value = trim(base64_decode(Mage::getStoreConfig($path, 0)));
		if ($value!='') {
			if (strpos($value, ',')) {
				$origValueGroups = explode(',',$value);			       		
        		foreach ($origValueGroups as $group) {
	    		    $key_value = explode('::',$group);
    			    $origValues[$key_value[0]] = $key_value[1];
        		}
			} else {
				$key_value = explode('::',$value);
				$origValues[$key_value[0]] = $key_value[1];
			}
        }
        		
        $valueArray = array(); 
        for ($i=0; $i<count($domains); $i++){
			Mage::getSingleton('core/session')->addSuccess('Saved');
			
			if ($this->getValue($i)!='') {
				$valueArray[] = $domains[$i].'::'.$this->getValue($i);
			}
		}
		
		$values = base64_encode(implode(',', $valueArray));
		$this->setValue($values);
    }
    
}