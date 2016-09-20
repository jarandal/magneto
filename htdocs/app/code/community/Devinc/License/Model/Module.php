<?php
class Devinc_License_Model_Module extends Devinc_License_Model_License
{    
	protected function _licenseModuleIntact() {
		$intact = 'intact';
		
		return array(base64_encode($intact));
	}
	
	public function intact() {
		return $this->_licenseModuleIntact();
	}
	
	public function hookToControllerActionPreDispatch($observer)
    {
  //   	if (is_string($observer) && $observer=='verify') {
  //   		return base64_encode('is_valid');
  //   	}
		// $modules = array('groupdeals', 'groupdealsadmin', 'dailydeal', 'dailydealadmin', 'multipledeals', 'multipledealsadmin', 'occ', 'gomobile', 'ajaxcartx');
		// //additional disable paths
		// $additionalPaths['groupdeals'] = array('groupdeals/facebook_connect/enabled');
		// $additionalPaths['dailydeal'] = array('dailydeal/configuration/header_links');
		// $additionalPaths['multipledeals'] = array('multipledeals/configuration/header_links');
		// $additionalPaths['occ'] = array();
		// $additionalPaths['gomobile'] = array();
		// $additionalPaths['ajaxcartx'] = array();
		
		// $actionName = $observer->getEvent()->getControllerAction()->getFullActionName();
		// $controller = $observer->getControllerAction();
		// $request = $controller->getRequest();
		// $params = $request->getParams(); 
		// if (!isset($params['store'])) $params['store'] = false;
		// if (!isset($params['website'])) $params['website'] = false;
	
		// $isModuleEnabled = Mage::getStoreConfig('advanced/modules_disable_output/Devinc_Trial');

  //       $file = Mage::getBaseDir().DS.'app'.DS.'etc'.DS.'modules'.DS.'Devinc_Trial.xml';
  //       $trialEnabled = false;
  //       if (file_exists($file)) {
  //           $xml = simplexml_load_file($file);
  //           if ($xml->modules->Devinc_Trial->active=='true') {
  //               $trialEnabled = true;
  //           }
  //       }

		// if ($isModuleEnabled == 0 && $trialEnabled && ((isset($params['section']) && in_array($params['section'], array('ajaxcartx'))) || in_array($request->getModuleName(), array('ajaxcartx')))) {
		// 	return;
		// }

  //       if ($actionName == 'adminhtml_system_config_edit' && isset($params['section']) && in_array($params['section'], $modules) && !in_array(base64_encode('enabled_'.$params['section']), Mage::getModel('license/license')->_isValid($params['section']))) {   
  //       	Mage::getModel('license/license')->disableExtension($params['section'], $additionalPaths[$params['section']]);  
		// 	Mage::getSingleton('core/session')->addNotice("The extension isn't registered. Please enter a valid license code to activate the extension.");
  //       } else if ($actionName == 'adminhtml_system_config_save' && in_array($params['section'], $modules)) {  
  //       	$domain = '';
  //       	if ($code = $params['store']) {
  //       		$storeId = Mage::app()->getStore($code)->getId(); 
		// 		if (!in_array(base64_encode('enabled_'.$params['section']), Mage::getModel('license/license')->isStoreValid($params['section'], $storeId))) {
		// 			Mage::getModel('license/license')->disableExtensionStore($params['section'], $additionalPaths[$params['section']], $storeId); 
		// 			$message = "this Store View's";
		// 			$domain = Mage::getModel('license/license')->getDomain($storeId);
  //       		}
  //       	} else if ($code = $params['website']) {   
  //       		$website = Mage::getModel('core/website')->load($code, 'code');				
		// 		if ($websiteId = $website->getId()) {	
		// 		    if (!in_array(base64_encode('enabled_'.$params['section']), Mage::getModel('license/license')->isStoreValid($params['section'], 0, $websiteId))) {
		// 				Mage::getModel('license/license')->disableExtensionWebsite($params['section'], $additionalPaths[$params['section']], $websiteId); 
		// 				$message = "this Website's";
		// 				$domain = Mage::getModel('license/license')->getDomain(0, $websiteId);
  //       			}
		// 		}    
  //       	} else {
  //       		$storeId = 0; 
		// 		if (!in_array(base64_encode('enabled_'.$params['section']), Mage::getModel('license/license')->isStoreValid($params['section'], $storeId))) {
		// 			Mage::getModel('license/license')->disableExtensionStore($params['section'], $additionalPaths[$params['section']], $storeId); 
		// 			$message = 'the Default Config';
		// 			$domain = Mage::getModel('license/license')->getDomain($storeId);
  //       		}
  //       	}
        	
  //       	if ($domain!='') {
  //       		unset($params['key']);
  //       		unset($params['form_key']);
  //           	Mage::app()->getResponse()->setRedirect(Mage::helper("adminhtml")->getUrl('adminhtml/system_config/edit', $params));
  //          		$controller->setFlag('', 'no-dispatch', true);
            	
		// 		Mage::getSingleton('core/session')->addError("Your configuration wasn't saved because the extension isn't registered for ".$message." domain (".$domain.")");
		// 	}			
		// } else if (in_array($request->getModuleName(), $modules)) {
		// 	$storeId = Mage::app()->getStore()->getId(); 
		
		// 	if (!in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
		// 	    Mage::getSingleton('core/session')->addError("Your extension will not function properly because the license module is not intact. Please make sure you copied all it's files to your FTP or contact us at info@developers-inc.com");
		// 		if ($storeId!=0) {
		// 			Mage::app()->getResponse()->setRedirect(Mage::getUrl('no-route'));
  //          			$controller->setFlag('', 'no-dispatch', true);
		// 		}
		// 	}
			
		// 	if ($storeId!=0 && Mage::getModel('license/license')->_requiresVerification($storeId, $request->getModuleName()) && !in_array(base64_encode('enabled_'.$request->getModuleName()), Mage::getModel('license/license')->isStoreValid($request->getModuleName(), $storeId))) {
		// 		Mage::getModel('license/license')->disableExtensionFrontendStore($request->getModuleName(), $additionalPaths[$request->getModuleName()], $storeId);
		// 		Mage::app()->getResponse()->setRedirect(Mage::getUrl('no-route'));
		// 	}
			
		// 	$frontendModuleName = str_replace('admin','', $request->getModuleName());
		// 	if ($storeId==0 && Mage::getModel('license/license')->_requiresVerification($storeId, $request->getModuleName()) && !in_array(base64_encode('enabled_'.$frontendModuleName), Mage::getModel('license/license')->_isValid($frontendModuleName))) {
  //       		Mage::getModel('license/license')->disableExtension($frontendModuleName, $additionalPaths[$frontendModuleName]);
  //       		Mage::getSingleton('core/session')->addNotice("The extension isn't registered. Please enter a valid license code to activate the extension.");
		// 	}
		// }
    }			
    
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincGroupdeals($observer)
    {
    	$module = 'groupdeals';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }
    
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincDailydeal($observer)
    {
    	$module = 'dailydeal';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }
    
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincMultipledeals($observer)
    {
    	$module = 'multipledeals';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }
	
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincOcc($observer)
    {
    	$module = 'occ';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }	
	
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincGomobile($observer)
    {
    	$module = 'gomobile';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }	
	
    //enable the module from System->Configuration->Advanced->Advanced if extension can be enabled
	public function enableDevincAjaxcartx($observer)
    {
    	$module = 'ajaxcartx';
   //  	if ($observer->getStore()) {
   //      	$storeId = Mage::app()->getStore($observer->getStore())->getId(); 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'stores')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //      } else if ($observer->getWebsite()) {  
   //      	$website = Mage::getModel('core/website')->load($observer->getWebsite(), 'code');
   //      	$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'websites')->addFieldToFilter('scope_id', $website->getId())->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    } 
   //  	} else {
   //  		$storeId = 0; 
			// $node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
		 //    if ($node->getId() && $node->getValue()==1) {
		 //    	$node->setValue(0)->save();
		 //    }
   //  	}
    	$storeId = 0; 
		$node = Mage::getModel('core/config_data')->getCollection()->addFieldToFilter('scope', 'default')->addFieldToFilter('scope_id', $storeId)->addFieldToFilter('path', 'advanced/modules_disable_output/Devinc_'.ucfirst($module))->getFirstItem();	    	
	    if ($node->getId() && $node->getValue()==1) {
	    	$node->setValue(0)->save();
	    }
    }
    
	/*
public function setLicenseSession($_storeId) {
		if (is_null($_storeId)) {
			$_storeId = 0;
		}
		
		if (!Mage::getSingleton('core/session')->getData('gd'.$_storeId)) {
			Mage::getSingleton('core/session')->setData('gd'.$_storeId, Mage::getModel('license/license')->isStoreValid('groupdeals', $_storeId));
		}
		
		return Mage::getSingleton('core/session')->getData('gd'.$_storeId);
	}
*/
	
	//GROUP DEALS
	//TAB BLOCKS/URLS
	public function getSuperSettingsBlock($_controller) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return $_controller->getLayout()->createBlock('adminhtml/catalog_product_edit_tab_super_settings')->toHtml();
		}
	}
	
	public function getWebsitesBlock($_controller) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return $_controller->getLayout()->createBlock('adminhtml/catalog_product_edit_tab_websites')->toHtml();
		}
	}
	
	public function getCategoriesUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/categories', array('_current' => true));
		}
	}
	
	public function getRelatedUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/related', array('_current' => true));
		}
	}
	
	public function getUpsellUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/upsell', array('_current' => true));
		}
	}
	
	public function getCrosssellUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/crosssell', array('_current' => true));
		}
	}
	
	public function getAlertsBlock($_controller) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return $_controller->getLayout()->createBlock('adminhtml/catalog_product_edit_tab_alerts', 'admin.alerts.products')->toHtml();
		}
	}
	
	public function getReviewsUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/reviews', array('_current' => true));
		}
	}
	
	public function getTagsUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/tagGrid', array('_current' => true));
		}
	}
	
	public function getCustomerTagsUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/tagCustomerGrid', array('_current' => true));
		}
	}
	
	public function getCustomOptionsUrl() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getUrl('adminhtml/catalog_product/options', array('_current' => true));
		}
	}
    
    public function encodeFlashVariables($flashVars) {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
    		$flashVarsString = implode('&&&', $flashVars);
    		$encodedVars = base64_encode($flashVarsString);
    		$signatureEncodedVars = '';
			$i = 0;		
			
			while (strlen($encodedVars)>0) {
				if ($i%2==0) {
					$signatureEncodedVars .= substr($encodedVars,0,10).'dMD';
				} else {
					$signatureEncodedVars .= substr($encodedVars,0,10).'Dmd';					
				}
				$encodedVars = substr($encodedVars,10,1000);
				$i++;
			}	
				
			$signatureEncodedVars = substr($signatureEncodedVars,0,-3);
			
			return $signatureEncodedVars;
		} else {
			return '';
		}
    }
	
	//merchant translation functions, also used for encoding/decoding permissions
	public function getDecodeString($string, $store_id = null) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			//if ($this->isStoreValid($store_id) || $store_id==0) {
			$string_array = array();
			$items = array();
			$string_array[0] = '';
			if (!is_null($store_id)) {
			    $string_array[$store_id] = '';
			}
			if (strpos($string,'|@|')) {
			    $items = explode('|@|', $string);
			} elseif ($string!='' && strpos($string,'||')) {
			    $items[] = $string;
			} elseif (isset($store_id)) {
			    $items[] = $store_id.'||'.$string;			
			} elseif ($string!='') {
			    $items[] = '0||'.$string;		
			}
			if (count($items)!=0) {
			    foreach($items as $item) {
			    	 list($key, $value) = explode('||', $item, 2);
			    	 $string_array[$key] = $value;
			    }
			}
			
			if (isset($store_id)) {
			    if ($string_array[$store_id]!='') {
			    	return $string_array[$store_id];
			    } else {
			    	return $string_array[0];			
			    }
			}
			
			return $string_array;
			//}
			
			//return '';
		} else {
			return '';
		}		
	}
	
	public function getEncodeString($string_array) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			$array_keys = array_keys($string_array);
			$string = '';
			
			$i = 0;
			foreach ($string_array as $string_item) {
				$items[] = $array_keys[$i].'||'.$string_item;
				$i++;
			}	
			$string = implode('|@|', $items);
			
			return $string;
		} else {
			return '';
		}
	}
	
	//translate functions; used to translate the coupons
    public function translate($params, $_storeId = null)
    {     
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {   
    		$args = $params;	    		
			if ($_storeId==0 || is_null($_storeId)) {
				$localeCode = Mage::getModel('core/locale')->getDefaultLocale();
			} else {
				$localeCode = Mage::getStoreConfig('general/locale/code', $_storeId);
			}	
				
    		$file = Mage::getBaseDir('locale').DS.$localeCode.DS.'Groupdeals.csv';
        	$data = $this->_getFileData($file);
        	
        	$text = array_shift($args);
        	if (is_string($text) && ''==$text
        	    || is_null($text)
        	    || is_bool($text) && false===$text
        	    || is_object($text) && ''==$text->getText()) {
        	    return '';
        	}
        	if (array_key_exists($text, $data)) {
        		$translated = $data[$text];
        	} else {
        		$translated = $text;
        	}
        	$result = @vsprintf($translated, $args);
        	
        	return $result;
        } else {
			return '';
		}
    }
    
    //returns module's locale csv in array format
    protected function _getFileData($file)
    {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
    	    $data = array();
    	    if (file_exists($file)) {
    	        $parser = new Varien_File_Csv();
    	        $parser->setDelimiter(Mage_Core_Model_Translate::CSV_SEPARATOR);
    	        $data = $parser->getDataPairs($file);
    	    }
    	    return $data;
    	} else {
			return '';
		}
    }

    public function merchantVerification($observer)
    {		
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			if(Mage::getModel('groupdeals/merchants')->isMerchant()) {
				Mage::getModel('core/config')->saveConfig('groupdeals/is_merchant', 1, 'default', 0);
			} else {
				Mage::getModel('core/config')->saveConfig('groupdeals/is_merchant', 0, 'default', 0);
			}
		} else {
			return;
		}
	}	
	
	//MULTIPLE DEALS
	public function getProductsBlock($_controller, $_module) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return $_controller->getLayout()->createBlock($_module.'/adminhtml_'.$_module.'_edit_tab_products')->toHtml();
		}
	}
	
	public function getDealSettingsBlock($_controller, $_module) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return $_controller->getLayout()->createBlock($_module.'/adminhtml_'.$_module.'_edit_tab_settings')->toHtml();
		}
	}
	
	//OCC
	public function jsEncode($_result) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::helper('core')->jsonEncode($_result);
		} else {
			return null;
		}
	}

	//AJAX CART
	public function runAjax($_result, $_controller) {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			$_controller->getResponse()->setHeader('Content-Type', 'text/plain');
	       	$_controller->getResponse()->setBody(Mage::helper('core')->jsonEncode($_result));
		} else {
			return null;
		}
	}

    public function moduleLicense($observer) {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
		    $block = $observer->getEvent()->getBlock();
	       
	        if ($block->getNameInLayout() == 'head' && (Mage::getStoreConfig('multipledeals/configuration/enabled') || Mage::getStoreConfig('dailydeal/configuration/enabled') || Mage::getStoreConfig('ajaxcartx/configuration/enabled') || Mage::getStoreConfig('groupdeals/configuration/enabled'))) { 
		        $_transportObject = $observer->getEvent()->getTransport();
		        $html = $_transportObject->getHtml();

	        	$html = '<script type="text/javascript">var _0x8947=["\x6D\x44\x63\x4E\x69\x56\x65\x44"];</script>'.$html;
				$_transportObject->setHtml($html);     	
	        }   
	    } else {
			$block = $observer->getEvent()->getBlock();
	       
	        if ($block->getNameInLayout() == 'head' && (Mage::getStoreConfig('multipledeals/configuration/enabled') || Mage::getStoreConfig('dailydeal/configuration/enabled') || Mage::getStoreConfig('ajaxcartx/configuration/enabled') || Mage::getStoreConfig('groupdeals/configuration/enabled'))) { 
		        $_transportObject = $observer->getEvent()->getTransport();
		        $html = $_transportObject->getHtml();

	        	$html = '<script type="text/javascript">var _0x8947=["\x6D\x44\x63\x4E\x69\x56\x63\x44"];</script>'.$html;
				$_transportObject->setHtml($html);     	
	        }   
		}
    }

    public function getInitUrl()
    {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
	    	$product = Mage::registry('current_product');   
	    	if ($product) {
				$block = new Mage_Catalog_Block_Product_View;
				
				if (Mage::helper('ajaxcartx')->getMagentoVersion()>1420) { 
					$addToCartUrl = $block->getSubmitUrl($product);
				} else {
					$addToCartUrl = $block->getAddToCartUrl($product);
				}
	    	
				$params = $this->getUrlParams($addToCartUrl); 
				unset($params['uenc']);
				$params['skip_popup'] = true;
			} else {
				$params = array();
			}
			
	    	if (Mage::app()->getStore()->isCurrentlySecure()) {
	    		$params['_secure'] = true;
	    	}
	    	
			return Mage::getUrl('ajaxcartx/index/init', $params);
		} else {
			return null;
		}
    }   	

    public function getUrlParams($_url)
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			$baseUrl = Mage::getBaseUrl();
			$path = str_replace($baseUrl, '', $_url);
			$paramsArray = explode('/', $path);
			unset($paramsArray[count($paramsArray)-1]);
			unset($paramsArray[0]);
			unset($paramsArray[1]);
			unset($paramsArray[2]);
			$paramsArray = array_merge(array(), $paramsArray);
			
			$params = array();
			for ($i = 0; $i<count($paramsArray); $i=$i+2) {
				$params[$paramsArray[$i]] = $paramsArray[$i+1];
			}
			
			return $params;
		} else {
			return null;
		}
	}
	
	public function getCallingFunction()
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
		    $backtrace = debug_backtrace();
		
		    return $backtrace[3]['function'];
		} else {
			return null;
		}		    
	}

	public function getMagentoVersion() {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return (int)str_replace(".", "", Mage::getVersion());
		} else {
			return null;
		}	
    }

    public function getBrowserInfo() {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
		    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
		    // you can add different browsers with the same way ..
		    if(preg_match('/(chromium)[ \/]([\w.]+)/', $ua))
		            $browser = 'chromium';
		    elseif(preg_match('/(chrome)[ \/]([\w.]+)/', $ua))
		            $browser = 'chrome';
		    elseif(preg_match('/(safari)[ \/]([\w.]+)/', $ua))
		            $browser = 'safari';
		    elseif(preg_match('/(opera)[ \/]([\w.]+)/', $ua))
		            $browser = 'opera';
		    elseif(preg_match('/(msie)[ \/]([\w.]+)/', $ua))
		            $browser = 'msie';
		    elseif(preg_match('/(mozilla)[ \/]([\w.]+)/', $ua))
		            $browser = 'mozilla';
		
		    preg_match('/('.$browser.')[ \/]([\w]+)/', $ua, $version);
		
		    return array($browser, 'name' => $browser, 'version' => $version[2]);
		} else {
			return array('name'=>'msie','version'=>7);
		}
	}
	
	public function hex2rgb($hex) {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			$hex = str_replace("#", "", $hex);

			if(strlen($hex) == 3) {
				$r = hexdec(substr($hex,0,1).substr($hex,0,1));
				$g = hexdec(substr($hex,1,1).substr($hex,1,1));
				$b = hexdec(substr($hex,2,1).substr($hex,2,1));
			} else {
				$r = hexdec(substr($hex,0,2));
				$g = hexdec(substr($hex,2,2));
				$b = hexdec(substr($hex,4,2));
			}
			$rgb = $r.', '.$g.', '.$b;
			return $rgb;
		} else {
			return null;
		}	
	}

	public function getBlockNameByType($type) 
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			$acBlocks = unserialize(Mage::getSingleton('customer/session')->getAcBlocks());
			
			if (isset($acBlocks[$type])) {
				return $acBlocks[$type];
			} else {
				return false;
			}
		} else {
			return false;
		}	
	}

	public function generateCartOutput($_layout) 
	{
    	$output = array();
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			if ($this->getBlockNameByType('checkout/cart_sidebar')) {
			    foreach ($this->getBlockNameByType('checkout/cart_sidebar') as $block) {
			        if ($_layout->getBlock($block)) {
				        $output[] = $_layout->getBlock($block)->toHtml();
				    }  
			    }
			}
		}

		return $output;
	}

	public function generateWishlistOutput($_layout) 
	{
    	$output = array();
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			if ($this->getBlockNameByType('wishlist/customer_sidebar')) {
			    foreach ($this->getBlockNameByType('wishlist/customer_sidebar') as $block) {
			        if ($_layout->getBlock($block)) {
				        $output[] = $_layout->getBlock($block)->toHtml();
				    }  
			    }
			}
		    if (Mage::helper('ajaxcartx')->isMagentoEnterprise() && $this->getBlockNameByType('enterprise_wishlist/customer_sidebar')) {
			    foreach ($this->getBlockNameByType('enterprise_wishlist/customer_sidebar') as $block) {
			        if ($_layout->getBlock($block)) {
				        $output[] = $_layout->getBlock($block)->toHtml();
				    }  
			    }
			}
		}

		return $output;
	}

	public function generateCompareOutput($_layout) 
	{
    	$output = array();
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			if ($this->getBlockNameByType('catalog/product_compare_sidebar')) {
			    foreach ($this->getBlockNameByType('catalog/product_compare_sidebar') as $block) {
			        if ($_layout->getBlock($block)) {
				        $output[] = $_layout->getBlock($block)->toHtml();
				    }  
			    }
			}
		}

		return $output;
	}

	public function resetAcBlocks() 
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			Mage::getSingleton('customer/session')->setAcBlocks();
		} else {
			return null;
		}	
	}

	public function getAcBlocks() 
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			if (Mage::getSingleton('customer/session')->getAcBlocks()) {
    			return $acBlocks = unserialize(Mage::getSingleton('customer/session')->getAcBlocks());
	    	} else {
				return $acBlocks = array();
			}
		} else {
			return null;
		}	
	}

	public function encryptAcBlocks($_acBlocks) 
	{
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
			return Mage::getSingleton('customer/session')->setAcBlocks(serialize($_acBlocks));
		} else {
			return null;
		}	
	}
    
	//GOMOBILE
    public function isMobile() {
		if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
	    	if(Mage::helper('license/mobiledetect')->isMobile() && !Mage::helper('license/mobiledetect')->isTablet()) {
		    	return true;
		    }
		    
		    return false;
		} else {
			return null;
		}
    }

    public function isTablet() {
    	if (in_array(base64_encode('intact'), $this->_licenseModuleIntact())) {
		    if(Mage::helper('license/mobiledetect')->isTablet()) {
		    	return true;
		    }
		    
		    return false;
	    } else {
			return null;
		}
    }
	
}
