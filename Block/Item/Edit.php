<?php

class Block_Item_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('item/edit.phtml');
    }

    public function getRow()
    {
        return $this->getData('row');
    }

    public function getAttributes()
    {
        return $this->getRow()->getAttributes();
    }
}