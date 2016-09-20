<?php
class Devinc_License_Model_License extends Mage_Core_Model_Abstract
{          
	//verify if module is registered and enabled for at least one domain  
	protected function _isValid($_module) {
		$result = 'enabled';
    	
		return array(base64_encode($result.'_'.$_module));		
    }
    
    //verify if module is registered and enabled for a specific domain
	public function isStoreValid($_module, $_storeId = 0, $_websiteId = null) {
		return array(base64_encode('enabled_'.$_module));
	}
	
	protected function _requiresVerification($_storeId, $_module) {		
		$resource = Mage::getSingleton('core/resource');
	    $connection = $resource->getConnection('core_read');

	    $select = $connection->select()
	    ->from($resource->getTableName('core_config_data'))
	    ->where('scope = ?', 'default')
	    ->where('scope_id = ?', 0)
	    ->where('path = ?', 'devinc_license/'.$_module.'/validation');

		$rows = $connection->fetchAll($select); 
		
		if (count($rows)>0) {
			$verifiedStoresString = trim(base64_decode($rows[0]['value']));
			$verifiedStoresArray = explode(',',$verifiedStoresString); 	
			
			foreach ($verifiedStoresArray as $store) {
				$storeDate = explode('::',$store);
				if ($_storeId==$storeDate[0]) {
					if ($this->_getCurrentDateTime($_storeId)>$storeDate[1]) {
						$this->_saveVerification($_storeId, $_module);
						return true;
					} else {
						return false;
					}
				}
			}
			
			$this->_saveVerification($_storeId, $_module);
			return true;
		} else {
			$this->_saveVerification($_storeId, $_module);
			return true;
		}
	}
	
	protected function _saveVerification($_storeId, $_module) {
		$resource = Mage::getSingleton('core/resource');
	    $connection = $resource->getConnection('core_read');

	    $select = $connection->select()
	    ->from($resource->getTableName('core_config_data'))
	    ->where('scope = ?', 'default')
	    ->where('scope_id = ?', 0)
	    ->where('path = ?', 'devinc_license/'.$_module.'/validation');

		$rows = $connection->fetchAll($select); 
		
		if (count($rows)>0) {
			$verifiedStoresString = trim(base64_decode($rows[0]['value']));
			$verifiedStoresArray = explode(',',$verifiedStoresString);
			$exist = false; 				
			$i = 0;
			
			foreach ($verifiedStoresArray as $store) {
				$storeDate = explode('::',$store);
				if ($_storeId==$storeDate[0]) {
					$nextVerificationDate = date('Y-m-d H:i:s', strtotime($this->_getCurrentDateTime($_storeId).'+1 hour'));					
					$verifiedStoresArray[$i] = $_storeId.'::'.$nextVerificationDate;
					$exist = true;
					break;
				} 
				$i++;
			}
			
			if (!$exist) {
				$nextVerificationDate = date('Y-m-d H:i:s', strtotime($this->_getCurrentDateTime($_storeId).'+1 hour'));					
				$verifiedStoresArray[] = $_storeId.'::'.$nextVerificationDate;
			}
			
			$verifiedStoresString = base64_encode(implode(',',$verifiedStoresArray)); 				
			Mage::getModel('core/config')->saveConfig('devinc_license/'.$_module.'/validation', $verifiedStoresString, 'default', 0);
		} else {
			$nextVerificationDate = date('Y-m-d H:i:s', strtotime($this->_getCurrentDateTime($_storeId).'+1 hour'));
			$verifiedStoresString = base64_encode($_storeId.'::'.$nextVerificationDate); 
			Mage::getModel('core/config')->saveConfig('devinc_license/'.$_module.'/validation', $verifiedStoresString, 'default', 0);			
		}
	}
	
	protected function _getCurrentDateTime($_storeId = null, $_format = 'Y-m-d H:i:s') {
		if (is_null($_storeId)) {
			$_storeId = Mage::app()->getStore()->getId();
		}
		$storeDatetime = new DateTime();
		$storeDatetime->setTimezone(new DateTimeZone(Mage::getStoreConfig('general/locale/timezone', $_storeId)));	
		
		return $storeDatetime->format($_format);
	}	
    
    //verify if the license for this domain has expired
	public function isExpired($_module, $_domain, $_license) {	        			
    	return false;	
	}

	//disable extension for all
    public function disableExtension($_module, $_additionalPaths) {
		
    }

	//disable extension for website
    public function disableExtensionWebsite($_module, $_additionalPaths, $_websiteId) {
		
    }

	//disable extension for store
    public function disableExtensionStore($_module, $_additionalPaths, $_storeId) {            
    	
	}

	//disable extension for frontend store
    public function disableExtensionFrontendStore($_module, $_additionalPaths, $_storeId) {            
    	
	}

	//get domain by store id
    public function getDomain($_storeId = 0, $_websiteId = null) {
    	if (is_null($_websiteId)) {
	    	$url = Mage::getStoreConfig('web/unsecure/base_url', $_storeId);   		
    	} else {
	    	$url = Mage::app()->getWebsite($_websiteId)->getConfig('web/unsecure/base_url');
    	}   
    	
    	$domain = str_ireplace('www.', '', parse_url($url, PHP_URL_HOST));  
    	
    	if (!ctype_digit(str_replace('.','',$domain))) {  	
    		$domainParts = explode('.', $domain);
    		$tlds = $this->getTLDs();
    		
    		$newDomainParts = array();
    		$i = count($domainParts);
			while ($i>=0) {
			    $i--;
			    $newDomainParts[$i] = $domainParts[$i];
			    if (!in_array(strtoupper($domainParts[$i]), $tlds) && $i!=(count($domainParts)-1)) {
			    	ksort($newDomainParts);
			    	$domain = implode('.',$newDomainParts);
			    	break;
			    }
			}	
		}
	    	    	
    	return $domain;
    }  

	//get domain extensions(.com, .co.uk etc.)
	public function getTLDs()
	{
		$lines = explode(',','AC,AD,AE,AERO,AF,AG,AI,AL,AM,AN,AO,AQ,AR,ARPA,AS,ASIA,AT,AU,AW,AX,AZ,BA,BB,BD,BE,BF,BG,BH,BI,BIZ,BJ,BM,BN,BO,BR,BS,BT,BV,BW,BY,BZ,CA,CAT,CC,CD,CF,CG,CH,CI,CK,CL,CM,CN,CO,COM,COOP,CR,CU,CV,CW,CX,CY,CZ,DE,DJ,DK,DM,DO,DZ,EC,EDU,EE,EG,ER,ES,ET,EU,FI,FJ,FK,FM,FO,FR,GA,GB,GD,GE,GF,GG,GH,GI,GL,GM,GN,GOV,GP,GQ,GR,GS,GT,GU,GW,GY,HK,HM,HN,HR,HT,HU,ID,IE,IL,IM,IN,INFO,INT,IO,IQ,IR,IS,IT,JE,JM,JO,JOBS,JP,KE,KG,KH,KI,KM,KN,KP,KR,KW,KY,KZ,LA,LB,LC,LI,LK,LR,LS,LT,LU,LV,LY,MA,MC,MD,ME,MG,MH,MIL,MK,ML,MM,MN,MO,MOBI,MP,MQ,MR,MS,MT,MU,MUSEUM,MV,MW,MX,MY,MZ,NA,NAME,NC,NE,NET,NF,NG,NI,NL,NO,NP,NR,NU,NZ,OM,ORG,PA,PE,PF,PG,PH,PK,PL,PM,PN,POST,PR,PRO,PS,PT,PW,PY,QA,RE,RO,RS,RU,RW,SA,SB,SC,SD,SE,SG,SH,SI,SJ,SK,SL,SM,SN,SO,SR,ST,SU,SV,SX,SY,SZ,TC,TD,TEL,TF,TG,TH,TJ,TK,TL,TM,TN,TO,TP,TR,TRAVEL,TT,TV,TW,TZ,UA,UG,UK,US,UY,UZ,VA,VC,VE,VG,VI,VN,VU,WF,WS,XN--0ZWM56D,XN--11B5BS3A9AJ6G,XN--3E0B707E,XN--45BRJ9C,XN--80AKHBYKNJ4F,XN--80AO21A,XN--90A3AC,XN--9T4B11YI5A,XN--CLCHC0EA0B2G2A9GCD,XN--DEBA0AD,XN--FIQS8S,XN--FIQZ9S,XN--FPCRJ9C3D,XN--FZC2C9E2C,XN--G6W251D,XN--GECRJ9C,XN--H2BRJ9C,XN--HGBK6AJ7F53BBA,XN--HLCJ6AYA9ESC7A,XN--J6W193G,XN--JXALPDLP,XN--KGBECHTV,XN--KPRW13D,XN--KPRY57D,XN--LGBBAT1AD8J,XN--MGB9AWBF,XN--MGBAAM7A8H,XN--MGBAYH7GPA,XN--MGBBH1A71E,XN--MGBC0A9AZCG,XN--MGBERP4A5D4AR,XN--MGBX4CD0AB,XN--O3CW4H,XN--OGBPF8FL,XN--P1AI,XN--PGBS0DH,XN--S9BRJ9C,XN--WGBH1C,XN--WGBL6A,XN--XKC2AL3HYE2A,XN--XKC2DL3A5EE0H,XN--YFRO4I67O,XN--YGBI2AMMX,XN--ZCKZAH,XXX,YE,YT,ZA,ZM,ZW');
		array_walk($lines, create_function('&$val', '$val = trim($val);'));
		
		return $lines;
	}

	//get license by store id
    public function getLicense($_module, $_storeId = 0, $_websiteId = null) {
    	$domain = $this->getDomain($_storeId, $_websiteId);
    	$license = '';   	
        
        $value = trim(base64_decode(Mage::getStoreConfig('devinc_license/'.$_module.'/domains', 0)));
        if ($value!='') { 
    		$licenseGroups = explode(',',$value);
        	foreach ($licenseGroups as $group) {
        	    $key_value = explode('::',$group);
        	    if ($key_value[0]==$domain) {
        	    	$license = $key_value[1];
        	    }
        	}   
		}
		
		return $license;
    }

	//get all the websites domains + the ones already saved in the modules license field
    public function getDomains($_module, $_websiteOnly = false) {
    	$domains = array();
    	$storeIds = $this->getStoreIds();
    	
    	foreach ($storeIds as $storeId) {
	    	$domains[] = $this->getDomain($storeId);
    	}
    	
    	if (!$_websiteOnly) {
    		$value = trim(base64_decode(Mage::getStoreConfig('devinc_license/'.$_module.'/domains', 0)));
    		if ($value!='') {
    			$licenseGroups = explode(',',$value);   
        		foreach ($licenseGroups as $group) {
        		    $key_value = explode('::',$group);
        		    if ($key_value[0]!='' && !in_array($key_value[0], $domains)) {
        		    	$domains[] = $key_value[0];
        		    }
        		}   
			}
    	}
    	
		$uDomains = array_unique($domains);
    	$uDomains = array_merge($uDomains);
    	
    	return $uDomains;
    }
     
    public function getStoreIds() {	
		$storeIds = array();
		
		$websiteCollection = Mage::getModel('core/website')->getCollection();
				
		if (count($websiteCollection)) {	
		    foreach ($websiteCollection as $website) 
		    {	
		    	$storeCollection = Mage::getModel('core/store')->getCollection()->addFieldToFilter('website_id', $website->getId())->setOrder('store_id', 'asc');
		    	//verify if at least one store is active from the website
		    	if (count($storeCollection)) {
		   			foreach ($storeCollection as $store) {
			    		$storeIds[] = $store->getId();
			   		}
			   	}
		    }		
		}
		
		return $storeIds;
	}

}