<?php

class Devinc_Groupdeals_Model_Mysql4_Groupdeals_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    public function _construct()
    {
        parent::_construct();
        $this->_init('groupdeals/groupdeals');
    }
}