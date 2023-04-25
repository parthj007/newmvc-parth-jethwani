<?php

class Model_Eav_Attribute extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Eav_Attribute_Collection');
        $this->setResourceClass('Model_Eav_Attribute_Resource');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Eav_Attribute_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if ($this->status) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Eav_Attribute_Resource::STATUS_DEFAULT];
    }

    public function getInputTypeText()
    {
        $inputTypes = $this->getResource()->getInputTypeOptions();
        if($this->input_type){
            return $inputTypes[$this->input_type];
        }
        return $inputTypes[Model_Eav_Attribute_Resource::INPUT_TYPE_TEXTBOX];
    }

    public function getInputType()
    {
        if($this->input_type){
            return $this->input_type;
        }
        return Model_Eav_Attribute_Resource::INPUT_TYPE_TEXTBOX;
    }

    public function getEntityType()
    {
        $entityId = $this->entity_type_id;
        $entity = Ccc::getModel('entity_type')->load($entityId);
        return  $entity->name;   
    }


    public function getOptions()
    {
        $attributeId = $this->getId();
        $option = Ccc::getModel('eav_attribute_option');
        $sql = "SELECT * FROM `{$option->getResource()->getTableName()}`
            WHERE `attribute_id` = '{$attributeId}'";   
        return $option->fetchAll($sql);
    }

}