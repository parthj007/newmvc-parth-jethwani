<?php

class Block_Salesman_Address_Show extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('customer/address/show.phtml');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }
}