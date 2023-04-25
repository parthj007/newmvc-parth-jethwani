<?php

class Block_Shipping_Grid extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $shipping=$this->getCollection();
        $this->setData(['shipping'=>$shipping]);
    }
    public function getCollection()
    {
        $query = 'SELECT * FROM `shipping`';
        $shipping = Ccc::getModel('shipping')->fetchAll($query);
        return $shipping;
    }
}
