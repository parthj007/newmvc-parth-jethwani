<?php

class Model_Quote_Address_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
        parent::__construct();
        $this->setPrimaryKey("address_id");
        $this->setTableName("quote_address");
    }
}

?>