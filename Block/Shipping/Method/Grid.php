<?php

class Block_Shipping_Method_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Shipping Methods');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('method_id',[
            'title' => 'Shipping Method Id'
        ]);

        $this->addColumn('name',[
            'title' => 'Name'
        ]);

        $this->addColumn('amount',[
            'title' => 'Amount'
        ]);

        $this->addColumn('status',[
            'title' => 'Status'
        ]);

        $this->addColumn('created_at',[
            'title' => 'Created At'
        ]);

        $this->addColumn('updated_at',[
            'title' => 'Updated At'
        ]);
        return parent::_prepareColumn();
    }

    protected function _prepareAction()
    {
        $this->addAction('edit',[
            'title' => 'EDIT',
            'method' => 'getEditUrl'
        ]);

        $this->addAction('delete',[
            'title' => 'DELETE',
            'method' => 'getDeleteUrl'
        ]);

        return parent::_prepareAction();
    }

    public function _prepareButtons()
    {
        $this->addButton('method_id',[
            'title'=>'Add New Method',
            'url'=>$this->getUrl('add')
        ]);

        return parent::_prepareButtons();
    }


    public function getCollection()
    {
        $shippingMethod = Ccc::getModel('shipping_method');
        $sql = "SELECT * FROM `{$shippingMethod->getResource()->getTableName()}` 
            ORDER BY `{$shippingMethod->getResource()->getPrimaryKey()}` DESC";
        return $shippingMethod->fetchAll($sql);
    }
}