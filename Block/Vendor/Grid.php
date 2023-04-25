<?php

class Block_Vendor_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Vendors');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('vendor_id',[
            'title'=>'Vendor Id'
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

        $this->addColumn('company',[
            'title'=>'Company'
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
        $this->addButton('vendor_id',[
            'title'=>'Add New Vendor',
            'url'=>$this->getUrl('add')
        ]);
        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $vendor = Ccc::getModel('vendor');
        $sql = "SELECT * FROM `{$vendor->getResource()->getTableName()}` 
        ORDER BY `{$vendor->getResource()->getPrimaryKey()}` DESC";
        return $vendor->fetchAll($sql);
    }
}