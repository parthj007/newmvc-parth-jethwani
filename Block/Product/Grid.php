<?php
class Block_Product_Grid extends Block_Core_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setTitle('Manage Products');
    }

    protected function _prepareColumn()
    {
        $this->addColumn('product_id',[
            'title' => 'Product Id'
        ]);

        $this->addColumn('name',[
            'title' => 'Name'
        ]);

        $this->addColumn('sku',[
            'title' => 'SKU'
        ]);

        $this->addColumn('cost',[
            'title' => 'Cost'
        ]);

        $this->addColumn('price',[
            'title' => 'Price'
        ]);

        $this->addColumn('quantity',[
            'title' => 'Quantity'
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
        $this->addAction('media',[
            'title' => 'MEDIA',
            'method' => 'getMediaUrl'
        ]);

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

    public function getMediaUrl($row, $key)
    {
        return $this->getUrl($key, 'product_media', ['pid'=>$row->getId()], true);
    }

    protected function _prepareButtons()
    {
        $this->addButton('product_id',[
            'title' => 'Add New Product',
            'url' => $this->getUrl('add',null,null,true)
        ]);
        $this->addButton('Import',[
            'title' => 'Import CSV',
            'url' => $this->getUrl('Import',null,null,true)
        ]);
        $this->addButton('Export',[
            'title' => 'Export CSV',
            'url' => $this->getUrl('Export',null,null,true)
        ]);
        return parent::_prepareButtons();
    }


    public function getNumberOfRecords($product)
    {
        $sql = "SELECT count('product_id') FROM `product`";
        $totalRecords = $product->fetchRow($sql);
        $totalRecords = $totalRecords->getData("count('product_id')");
        return $totalRecords;
    }

    public function getCollection()
    {
        $product = Ccc::getModel('product');
        $pager = $this->getPager();
        $pager->setTotalRecords($this->getNumberOfRecords($product))->caculate();
        $start = $pager->getStartLimit();
        $rpp = $pager->getRecordPerPage();
        $sql = "SELECT * FROM `product` ORDER BY 'product_id' LIMIT $start,$rpp";
        return $product->fetchAll($sql);
    }
}