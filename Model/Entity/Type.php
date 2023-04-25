<?php
class Model_Entity_Type extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Entity_Type_Collection');
        $this->setResourceClass('Model_Entity_Type_Resource');
    }
}