<?php

class Block_Shipping_Method_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('shipping/method/edit.phtml');
    }

    public function getShippingMethod()
    {
        return $this->getData('shippingMethod');
    }

}