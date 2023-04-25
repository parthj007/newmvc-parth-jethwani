<?php
class Model_Item extends Model_Core_Table
{
    const ENTITY_TYPE_ID = 6;

    public function __construct()
    {
        parent::__construct();
        $this->setResourceClass('Model_Item_Resource');
        $this->setCollectionClass('Model_Item_Collection');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Product_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $this->getResource()->getStatusOptions())) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Item_Resource::STATUS_DEFAULT];
    }

    public function getAttributes()
    {
        $attribute = Ccc::getModel('eav_attribute');
        $sql = "SELECT * FROM `{$attribute->getResource()->getTableName()}`
            WHERE `entity_type_id` = '6' AND `status` = 1";
        return $attribute->fetchAll($sql);
    }

    public function getAttributeValue(Model_Eav_Attribute $attribute)
    {
        $sql = "SELECT `value` FROM `item_{$attribute->backend_type}` WHERE `entity_id` = '{$this->getId()}' AND `attribute_id` = '{$attribute->getId()}'";
        return $this->getResource()->getAdapter()->fetchOne($sql);
    }
}

?>