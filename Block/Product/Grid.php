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
            'url' => $this->getUrl('add')
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
        $currentPage = $this->getData("page");
        Ccc::log($currentPage,"currentPage.log");
        $pager = $this->getPager($this->getNumberOfRecords($product),$currentPage);
        Ccc::log($pager,"pager.log");
        $sql = "SELECT * FROM `product` ORDER BY 'product_id' LIMIT $pager->start,$pager->recordPerPage";
        Ccc::log($sql,"pager.log");
        return $product->fetchAll($sql);
    }
}