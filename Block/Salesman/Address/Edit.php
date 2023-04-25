<?php

class Block_Salesman_Address_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('salesman/edit.phtml');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }
}