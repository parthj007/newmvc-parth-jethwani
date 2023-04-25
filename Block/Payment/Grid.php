<?php

class Block_Payment_Grid extends Block_Core_Grid
{
    
    public function __construct()
    {
        parent::__construct();
        $this->_setTitle("Manage Payment Methods");
    }

    protected function _prepareColumns()    
    {
        $this->_addColumn("name",[
            "title"=>"Name"
        ]);
         $this->_addColumn("status",[
            "title"=>"Status"
        ]);
        $this->_addColumn("cost",[
            "title"=>"Cost"
        ]);
        $this->_addColumn("created_at",[
            "title"=>"Created At"
        ]);
        $this->_addColumn("updated_at",[
            "title"=>"Updated At"
        ]);

        return parent::_prepareColumns();
    }


    protected function _prepareActions()    
    {
        $this->_addAction("edit",[
            "title"=>"Edit",
            "method"=>"getEditUrl"
        ]);
        $this->_addAction("delete",[
            "title"=>"Delete",
            "method"=>"getDeleteUrl"
        ]);

        return parent::_prepareColumns();
    }


    protected function _prepareButtons()    
    {
        $this->_addButton("add-btn",[
            "title"=>"Add Payment",
            "method"=> $this->getUrl('add')
        ]);
        return parent::_prepareButtons();
    }
    
    public function getCollection()
    {
        $query = 'SELECT * FROM `payment`';
        $payments = Ccc::getModel('Payment')->fetchAll($query);
        return $payments;
    }
}
