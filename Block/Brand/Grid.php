<?php

class Block_Brand_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Brands');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('brand_id',[
            'title'=>'Brand Id'
        ]);

        $this->addColumn('name',[
            'title'=>'Name'
        ]);

        $this->addColumn('description',[
            'title'=>'Description'
        ]);

        $this->addColumn('image',[
            'title'=>'Image'
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
        $this->addButton('brand_id',[
            'title'=>'Add New Brand',
            'url'=>$this->getUrl('add')
        ]);

        return parent::_prepareButtons();
    }

    public function getCollection()
    {
        $brand = Ccc::getModel('brand');
        $sql = "SELECT * FROM `{$brand->getResource()->getTableName()}` 
            ORDER BY `{$brand->getResource()->getPrimaryKey()}` DESC";
        return $brand->fetchAll($sql);
    }
}