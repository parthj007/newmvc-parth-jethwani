<?php

class Block_Customer_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Customers');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('customer_id',[
            'title'=>'Customer Id'
        ]);

        $this->addColumn('fname',[
            'title'=>'First Name'
        ]);

        $this->addColumn('lname',[
            'title'=>'Last Name'
        ]);

        $this->addColumn('email',[
            'title'=>'Email'
        ]);

        $this->addColumn('mobile',[
            'title'=>'Mobile'
        ]);

        $this->addColumn('gender',[
            'title'=>'Gender'
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

    protected function _prepareAction()
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
        $this->addButton('customer_id',[
            'title'=>'Add New Customer',
            'url'=>$this->getUrl('add')
        ]);
        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $customer = Ccc::getModel('customer');
        $sql = "SELECT * FROM `{$customer->getResource()->getTableName()}` 
            ORDER BY `{$customer->getResource()->getPrimaryKey()}` DESC";
        return $customer->fetchAll($sql);
    }
}