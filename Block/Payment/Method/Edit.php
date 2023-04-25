<?php

class Block_Payment_Method_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('payment/method/edit.phtml');
    }

    public function getPaymentMethod()
    {
        return $this->getData('paymentMethod');
    }

}