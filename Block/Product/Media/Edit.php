<?php
class Block_Product_Media_Edit extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('product/media/edit.phtml');
    }

    public function getMedia()
    {
        return $this->getData('media');
    }
}