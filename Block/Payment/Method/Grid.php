<?php

class Block_Payment_Method_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Payment Methods');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('method_id',[
            'title'=>'Payment Method Id'
        ]);
        $this->addColumn('name',[
            'title'=>'Name'
        ]);
        $this->addColumn('status',[
            'title'=>'Status'
        ]);
        $this->addColumn('created_at',[
            'title'=>'Created At'
        ]);
        $this->addColumn('updated_at',[
            'title'=>'Updated At'
        ]);
        return parent::_prepareColumn();
    }

    public function _prepareAction()
    {
        $this->addAction('edit',[
            'title'=>'EDIT',
            'method'=>'getEditUrl'
        ]);

        $this->addAction('delete',[
            'title'=>'DELETE',
            'method'=>'getDeleteUrl'
        ]);
        return parent::_prepareAction();
    }

    public function _prepareButtons()
    {
        $this->addButton('method_id',[
            'title' => 'Add New Payment Method',
            'url' => $this->getUrl('add')
        ]);
        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $paymentMethod = Ccc::getModel('payment_method');
        $sql = "SELECT * FROM `{$paymentMethod->getResource()->getTableName()}` 
            ORDER BY `{$paymentMethod->getResource()->getPrimaryKey()}` DESC";
        return $paymentMethod->fetchAll($sql);
    }
}