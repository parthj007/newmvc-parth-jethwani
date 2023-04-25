<?php

class Block_Quote_Customer extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('quote/edit.phtml');
    }

    public function getQuote()
    {
        return Ccc::getModel("quote")->loadQuote($customer);   
    }

}