<?php

class Block_Vendor_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('vendor/edit.phtml');
    }

    public function getVendor()
    {
        return $this->getData('vendor');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }
}