<?php

class Block_Customer_Address_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('customer/edit.phtml');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }
}