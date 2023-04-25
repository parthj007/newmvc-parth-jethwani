<?php

class Model_Vendor_Address_Resource extends Model_Core_Table_Resource
{
    public function __construct()
    {
        parent::__construct();
        $this->setPrimaryKey('address_id')->setTableName('vendor_address');
    }
}

?>