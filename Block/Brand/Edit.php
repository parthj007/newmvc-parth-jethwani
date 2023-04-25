<?php

class Block_Brand_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('brand/edit.phtml');
    }

    public function getBrand()
    {
        return $this->getData('brand');
    }

}