<?php

require_once("Model/Core/Table.php");

class Model_Cart extends Model_Core_Table
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;
    
    protected $tableName = "cart";
    protected $primaryKey = "cart_id";
}

?>