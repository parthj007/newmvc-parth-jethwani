<?php

class Block_Customer_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('customer/edit.phtml');
    }

    public function getCustomer()
    {
        return $this->getData('customer');
    }

    public function getBillingAddress()
    {
        return $this->getData('billingAddress');
    }

    public function getShippingAddress()
    {
        return $this->getData('shippingAddress');
    }
}