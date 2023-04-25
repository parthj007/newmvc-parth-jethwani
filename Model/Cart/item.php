<?php
require_once("Model/Core/Table.php");

class Model_Cart_Item extends Model_Core_Table
{
    protected $tableName = "cart_item";
    protected $primaryKey = "item_id";
}
?>