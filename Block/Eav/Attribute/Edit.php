<?php

class Block_Eav_Attribute_Edit extends Block_Core_Template
{

    public function __construct()
    {
        
        $this->setTemplate('eav/attribute/edit.phtml');
    }

    public function getAttribute()
    {
        return $this->getData('attribute');
    }

    public function getOptions()
    {
        return $this->getData('options');
    }

    public function getEntities()
    {
        return $this->getData('entities');
    }
}