<?php

class Block_Eav_Attribute_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle("Manage Eav Attributes");
    }

    protected function _prepareColumn()
    {
        $this->addColumn('attribute_id',[
            'title'=>'Attribute Id'
        ]);

        $this->addColumn('name',[
            'title'=>'Name',
        ]);

        $this->addColumn('entity_type_id',[
            'title'=>'Entity Type',
        ]);

        $this->addColumn('code',[
            'title'=>'Code',
        ]);

        $this->addColumn('backend_type',[
            'title'=>'Backend Type',
        ]);

        $this->addColumn('status',[
            'title'=>'Status',
        ]);

        $this->addColumn('backend_model',[
            'title'=>'Backend Model',
        ]);

        $this->addColumn('input_type',[
            'title'=>'Input Type',
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

    public function getColumnValue($row, $key)
    {
        if($key == 'entity_type_id'){
            return $row->getEntityType();
        }elseif($key == 'status'){
            return $row->getStatusText();
        }else{
            return $row->$key;
        }
    }

    public function _prepareButtons()
    {
        $this->addButton('attribute_id',[
            'title'=>'Add New Attribute',
            'url'=>$this->getUrl('add')
        ]);

        return parent::_prepareButtons();
    }


    public function getCollection()
    {
        $attribute = Ccc::getModel('eav_attribute');
        $sql = "SELECT * FROM `{$attribute->getResource()->getTableName()}` 
            ORDER BY `{$attribute->getResource()->getPrimaryKey()}`";
        return $attribute->fetchAll($sql);
    }


}