<?php
class Model_Brand extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Brand_Collection');
        $this->setResourceClass('Model_Brand_Resource');
    }

   


}

?>