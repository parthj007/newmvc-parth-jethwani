<?php

class Block_Admin_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Admins');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('admin_id',[
            'title'=>'Admin Id'
        ]);

        $this->addColumn('email',[
            'title'=>'Email'
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
        $this->addAction('edit', [
            'title'=>'EDIT',
            'method'=>'getEditUrl'
        ]);

        $this->addAction('delete', [
            'title'=>'DELETE',
            'method'=>'getDeleteUrl'
        ]);

        return parent::_prepareAction();
    }

    protected function _prepareButtons()
    {
        $this->addButton('admin_id',[
            'title'=>'Add New Admin',
            'url'=>$this->getUrl('add')
        ]);

        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $admin = Ccc::getModel('admin');
        $sql = "SELECT * FROM `{$admin->getResource()->getTableName()}` 
            ORDER BY `{$admin->getResource()->getPrimaryKey()}` DESC";
        return $admin->fetchAll($sql);
    }
}