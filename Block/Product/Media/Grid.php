<?php
class Block_Product_Media_Grid extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('product/media/grid.phtml');
    }


    public function getProductId()
    {
        return $this->getData('productId');
    }

    public function getProductName()
    {
        return $this->getData('productName');
    }

    public function getBase()
    {
        return $this->getData('base');
    }

    public function getSmall()
    {
        return $this->getData('small');
    }

    public function getThumb()
    {
        return $this->getData('thumb');
    }



    public function getMedias()
    {
        $product = Ccc::getModel('product');
        $media = Ccc::getModel('product_media');
        $sql = "SELECT * FROM `{$media->getResource()->getTableName()}` 
            WHERE `{$product->getResource()->getPrimaryKey()}` = '{$this->getProductId()}'
            ORDER BY `{$media->getResource()->getPrimaryKey()}` DESC";
        return $media->fetchAll($sql);
    }
}