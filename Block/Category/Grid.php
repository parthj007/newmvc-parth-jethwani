<?php

class Block_Category_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Categories');
    }

    public function _prepareColumn()
    {
        $this->addColumn('category_id',[
            'title'=>'Category Id'
        ]);

        $this->addColumn('path',[
            'title'=>'Path'
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

        parent::_prepareAction();
    }

    public function _prepareButtons()
    {   
        $this->addButton('category_id',[
            'title'=>'Add New Category',
            'url'=>$this->getUrl('add')
        ]);

        parent::_prepareButtons();
    }

    public function getColumnValue($row, $key)
    {
        if($key == 'status'){
            return $row->getStatusText();
        }
        elseif($key == 'path'){
            $pathCategories = $row->preparePathCategories();
            return $pathCategories[$row->getId()];
        }else{
            return $row->$key;
        }
    }

    public function getCollection()
    {
        $category = Ccc::getModel('category');
        $sql = "SELECT * FROM `{$category->getResource()->getTableName()}` 
            WHERE `parent_id`>'0'
            ORDER BY `path`";
        $categories = $category->fetchAll($sql);
        return $categories;
    }
}