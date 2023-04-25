<?php

class Block_Salesman_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('salesman/edit.phtml');
    }

    public function getsalesman()
    {
        return $this->getData('salesman');
    }

    public function getAddress()
    {
        return $this->getData('address');
    }
}