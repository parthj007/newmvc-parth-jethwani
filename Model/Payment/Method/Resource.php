<?php

class Model_Payment_Method_Resource extends Model_Core_Table_Resource
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    public function __construct()
    {
        parent::__construct();
        $this->setPrimaryKey("method_id");
        $this->setTableName("payment_method");
    }
    public function getStatusOptions()
    {
        return array(
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
        );
    }
}

?>