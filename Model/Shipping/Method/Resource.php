<?php

class Model_Shipping_Method_Resource extends Model_Core_Table_Resource
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    public function __construct()
    {
        parent::__construct();
        $this->setTableName("Shipping_Method");
        $this->setPrimaryKey("method_id");
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
        ];
    }

}

?>