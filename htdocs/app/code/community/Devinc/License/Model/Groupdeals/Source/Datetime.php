<?php
if (in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) {
    class Devinc_License_Model_Groupdeals_Source_Datetime extends Mage_Eav_Model_Entity_Attribute_Backend_Abstract
    {
        /**
         * Formating date value before save
         *
         * Should set (bool, string) correct type for empty value from html form,
         * neccessary for farther proccess, else date string
         *
         * @param Varien_Object $object
         * @throws Mage_Eav_Exception
         * @return Mage_Eav_Model_Entity_Attribute_Backend_Datetime
         */
        public function beforeSave($object)
        {
            $attributeName = $this->getAttribute()->getName();
            $_formated     = $object->getData($attributeName . '_is_formated');
            if (!$_formated && $object->hasData($attributeName)) {
                try {
                    $value = $this->formatDate($object->getData($attributeName));
                } catch (Exception $e) {
                    throw Mage::exception('Mage_Eav', Mage::helper('eav')->__('Invalid date'));
                }

                if (is_null($value)) {
                    $value = $object->getData($attributeName);
                }

                $object->setData($attributeName, $value);
                $object->setData($attributeName . '_is_formated', true);
            }
        
            return $this;
        }

        /**
         * Prepare date for save in DB
         *
         * string format used from input fields (all date input fields need apply locale settings)
         * int value can be declared in code (this meen whot we use valid date)
         *
         * @param   string | int $date
         * @return  string
         */
        public function formatDate($date)
        {
            if (empty($date)) {
                return null;
            }
            // unix timestamp given - simply instantiate date object
            if (preg_match('/^[0-9]+$/', $date)) {
                $date = new Zend_Date((int)$date);
            }
            // international format
            else if (preg_match('#^\d{4}-\d{2}-\d{2}( \d{2}:\d{2}:\d{2})?$#', $date)) {
                $zendDate = new Zend_Date();
                $date = $zendDate->setIso($date);
            }
            // parse this date in current locale, do not apply GMT offset
            else {
                $date = Mage::app()->getLocale()->date($date,
                   Mage::app()->getLocale()->getDatetimeFormat(Mage_Core_Model_Locale::FORMAT_TYPE_SHORT),
                   null, false
                );
            }
            return $date->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);
        }
    }
} else {
    class Devinc_License_Model_Groupdeals_Source_Datetime extends Varien_Object 
    {
    }
}