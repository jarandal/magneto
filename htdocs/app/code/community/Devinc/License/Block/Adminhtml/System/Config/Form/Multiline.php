<?php
class Devinc_License_Block_Adminhtml_System_Config_Form_Multiline extends Mage_Adminhtml_Block_System_Config_Form_Field
{    	
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '';
        $element->setClass('input-text');
        
        $elementNameParts = explode('][', $element->getName());
        $module = str_replace('groups[', '', $elementNameParts[0]);
        
        $domains = Mage::getModel('license/license')->getDomains($module);
        $lineCount = count($domains);
        
        $values = array();
        foreach ($domains as $domain) {
        	$values[$domain] = '';
        }
        
		$value = trim(base64_decode($element->getValue()));
		if ($value!='') {
			if (strpos($value, ',')) {
				$valueGroups = explode(',',$value);			       		
        		foreach ($valueGroups as $group) {
	    		    $key_value = explode('::',$group);
    			    $values[$key_value[0]] = $key_value[1];
        		}
			} else {
				$key_value = explode('::',$value);
				$values[$key_value[0]] = $key_value[1];
			}
        }

        for ($i=0; $i<$lineCount; $i++){  
        	$expired = '';
        	if ($values[$domains[$i]]!='' && Mage::getModel('license/license')->isExpired($module, $domains[$i], $values[$domains[$i]])) {
        		$expired = ' (License expired)';
        	}
            $html.= '<td class="label" style="width:auto;"><label for="'.$element->getHtmlId().$i.'" style="width:100%;">'.$domains[$i].$expired.'</label></td>'."\n";             
            $html.= '<td class="value"><input id="'.$element->getHtmlId().$i.'" name="'.$element->getName().'['.$i.']" value="'.$values[$domains[$i]].'"'.$element->serialize($element->getHtmlAttributes()).' /></td>'."\n";  
            if (($i+1)<$lineCount) $html.= '</tr><tr>';       
        }
                
        return $html;
    }      
      
    public function render(Varien_Data_Form_Element_Abstract $element)
    {     
    	$html = '';   
        $html .= $this->_getElementHtml($element);
        
        return $html;
    }
}
