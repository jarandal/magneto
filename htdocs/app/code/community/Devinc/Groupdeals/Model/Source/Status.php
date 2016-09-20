<?php

class Devinc_Groupdeals_Model_Source_Status extends Devinc_License_Model_Groupdeals_Source_Status
{
    const STATUS_QUEUED		= 1;
    const STATUS_RUNNING	= 2;
    const STATUS_DISABLED	= 3;
    const STATUS_ENDED  	= 4;
    const STATUS_PENDING	= 5;

    static public function getOptionArray()
    {
        return array(
            self::STATUS_QUEUED     => Mage::helper('groupdeals')->__('Queued'),
            self::STATUS_RUNNING    => Mage::helper('groupdeals')->__('Running'),
            self::STATUS_ENDED      => Mage::helper('groupdeals')->__('Ended'),
            self::STATUS_DISABLED   => Mage::helper('groupdeals')->__('Disabled'),
            self::STATUS_PENDING    => Mage::helper('groupdeals')->__('Pending Approval'),
        );
    }
    
    static public function getAllOptions()
    {
        $res = array(
            array(
                'value' => '',
                'label' => Mage::helper('catalog')->__('-- Please Select --')
            )
        );
        foreach (self::getOptionArray() as $index => $value) {
            $res[] = array(
               'value' => $index,
               'label' => $value
            );
        }
        return $res;
    } 
}