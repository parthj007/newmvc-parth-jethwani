<?php
class Model_Salesman_Price extends Model_Core_Table
{

    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Salesman_Price_Collection');
        $this->setResourceClass('Model_Salesman_Price_Resource');
    }

}

?>