<?php

class Block_Quote_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('quote/grid.phtml');
    }

    public function getCollection()
    {
        $customer = Ccc::getModel('customer');
        $sql = "SELECT * FROM `{$customer->getResource()->getTableName()}` ORDER BY `{$customer->getResource()->getPrimaryKey()}` DESC";
        return $customer->fetchAll($sql);
    }

    public function getQuote()
    {
        return Ccc::getModel("quote")->loadQuote();
    }
}