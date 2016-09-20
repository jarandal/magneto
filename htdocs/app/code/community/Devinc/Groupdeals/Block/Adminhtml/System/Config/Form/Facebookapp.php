<?php
class Devinc_Groupdeals_Block_Adminhtml_System_Config_Form_Facebookapp extends Mage_Adminhtml_Block_System_Config_Form_Field
{    
    protected function _getElementHtml(Varien_Data_Form_Element_Abstract $element)
    {
        $html = '<tr><td style="position:absolute; padding:5px;">
                    If you want to use these Facebook plugins, you have to create a Facebook App to get the "Application Api Key" and "Application Secret".<br/>Click here to see our tutorial on <a href="http://www.developers-inc.com/facebook-app" target="_blank">How to create a Facebook App</a>.
                </td><td class="value" style="height:38px;">&nbsp;</td></tr>'; 

        return $html;
    }     
      
    public function render(Varien_Data_Form_Element_Abstract $element)
    {     
        $html = $this->_getElementHtml($element);
        
        return $html;
    }
}
 