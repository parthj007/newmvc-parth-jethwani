<?php

class Model_Salesman_Address extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Salesman_Address_Collection');
        $this->setResourceClass('Model_Salesman_Address_Resource');
    }

}

?>