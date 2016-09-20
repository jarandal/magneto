<?php
if (in_array(base64_encode('intact'), Mage::getModel('license/module')->intact())) {
    class Devinc_License_Model_Groupdeals_Source_Status extends Varien_Object
    {
        public function addValueSortToCollection($collection, $dir = 'asc')
        {
            if ($this->getAttribute()->isScopeGlobal()) {
                $tableName = $this->getAttribute()->getAttributeCode() . '_t';
                $collection->getSelect()
                    ->joinLeft(
                        array($tableName => $this->getAttribute()->getBackend()->getTable()),
                        "`e`.`entity_id`=`{$tableName}`.`entity_id`"
                            . " AND `{$tableName}`.`attribute_id`='{$this->getAttribute()->getId()}'"
                            . " AND `{$tableName}`.`store_id`='0'",
                        array());
                $valueExpr = $tableName . '.value';
            }
            else {
                $valueTable1    = $this->getAttribute()->getAttributeCode() . '_t1';
                $valueTable2    = $this->getAttribute()->getAttributeCode() . '_t2';
                $collection->getSelect()
                    ->joinLeft(
                        array($valueTable1 => $this->getAttribute()->getBackend()->getTable()),
                        "`e`.`entity_id`=`{$valueTable1}`.`entity_id`"
                            . " AND `{$valueTable1}`.`attribute_id`='{$this->getAttribute()->getId()}'"
                            . " AND `{$valueTable1}`.`store_id`='0'",
                        array())
                    ->joinLeft(
                        array($valueTable2 => $this->getAttribute()->getBackend()->getTable()),
                        "`e`.`entity_id`=`{$valueTable2}`.`entity_id`"
                            . " AND `{$valueTable2}`.`attribute_id`='{$this->getAttribute()->getId()}'"
                            . " AND `{$valueTable2}`.`store_id`='{$collection->getStoreId()}'",
                        array()
                    );
                $valueExpr = new Zend_Db_Expr("IF(`{$valueTable2}`.`value_id`>0, `{$valueTable2}`.`value`, `{$valueTable1}`.`value`)");
            }

            $collection->getSelect()->order($valueExpr . ' ' . $dir);

            return $this;
        }

        /**
         * Retrieve flat column definition
         *
         * @return array
         */
        public function getFlatColums()
        {
            $attributeCode = $this->getAttribute()->getAttributeCode();
            $column = array(
                'unsigned'  => true,
                'default'   => null,
                'extra'     => null
            );

            if (Mage::helper('core')->useDbCompatibleMode()) {
                $column['type']     = 'int';
                $column['is_null']  = true;
            } else {
                $column['type']     = Varien_Db_Ddl_Table::TYPE_INTEGER;
                $column['nullable'] = true;
                $column['comment']  = $attributeCode . ' groupdeals status column';
            }

            return array($attributeCode => $column);
        }

        /**
         * Retrieve Select for update attribute value in flat table
         *
         * @param   int $store
         * @return  Varien_Db_Select|null
         */
        public function getFlatUpdateSelect($store)
        {
            return Mage::getResourceModel('eav/entity_attribute_option')
                ->getFlatUpdateSelect($this->getAttribute(), $store, false);
        }
    }
} else {
    class Devinc_License_Model_Groupdeals_Source_Status extends Varien_Object
    {        
    }
}