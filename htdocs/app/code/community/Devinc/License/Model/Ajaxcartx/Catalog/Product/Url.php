<?php
class Devinc_License_Model_Ajaxcartx_Catalog_Product_Url extends Mage_Catalog_Model_Product_Url
{
 	public function getUrl(Mage_Catalog_Model_Product $product, $params = array())
    {
    	if (in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) {
	    	if (Mage::helper('ajaxcartx')->isEnabled() && (isset($params['_query']) && isset($params['_query']['options']) && $params['_query']['options']=='cart')) {
		    	return Mage::helper('checkout/cart')->getAddUrl($product, $params);
	    	} else {
		    	return parent::getUrl($product, $params);
	    	}
	    }	
    }
	
}