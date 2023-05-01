<?php

class Block_Salesman_Grid extends Block_Core_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Salesmen');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('salesman_id',[
            'title'=>'Salesman Id'
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
        $this->addAction('grid',[
            'title'=>'PRICE',
            'method'=>'getPriceUrl'
        ]);

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

    public function getPriceUrl($row, $key)
    {
        return $this->getUrl($key, 'salesman_price', ['id'=>$row->getId()], true);
    }

    public function _prepareButtons()
    {
        $this->addButton('salesman_id',[
            'title'=>'Add New Salesman',
            'url'=>$this->getUrl('add')
        ]);
        return parent::_prepareButtons();
    }

     public function getNumberOfRecords()
    {
       $sql = "SELECT COUNT(`salesman_id`) FROM `salesman` ORDER BY `salesman_id` DESC";
        $total = Ccc::getModel('Core_Adapter')->fetchOne($sql);
        return $total;
    }

    public function getCollection()
    {

        $salesman = Ccc::getModel('salesman');
        $pager=$this->getPager();
        $pager->setTotalRecords($this->getNumberOfRecords())->caculate();
        $start = $pager->getStartLimit();
        $rpp = $pager->getRecordPerPage();
        $sql = "SELECT * FROM `{$salesman->getResource()->getTableName()}` 
            ORDER BY `{$salesman->getResource()->getPrimaryKey()}` DESC
            LIMIT $start,$rpp";
        return $salesman->fetchAll($sql);
    }
}
