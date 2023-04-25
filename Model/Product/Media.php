<?php

class Model_Product_Media extends Model_Core_Table
{

    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass("Model_Product_Media_Collection");
        $this->setResourceClass("Model_Product_Media_Resource");
    }

}

?>