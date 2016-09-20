<?php
$installer = $this;

$installer->startSetup();

//create group deals block permission
if (Mage::getModel('admin/block')) {
	$ddBlock = Mage::getModel('admin/block')->getCollection()->addFieldToFilter('block_name', 'groupdeals/product_list');
	if (count($ddBlock)==0) {
	    $block = array(
	                    'block_name' => 'groupdeals/product_list',
	                    'is_allowed' => 1                    
	                    );
	    Mage::getModel('admin/block')->setData($block)->save();
	}
}

$installer->endSetup();