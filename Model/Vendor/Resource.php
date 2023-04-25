<?php

class Model_Vendor_Resource extends Model_Core_Table_Resource
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;
    const GENDER_MALE = 1;
    const GENDER_FEMALE = 2;
    const GENDER_MALE_LBL = 'Male';
    const GENDER_FEMALE_LBL = 'Female';

    public function __construct()
    {
        parent::__construct();
        $this->setPrimaryKey('vendor_id')->setTableName('vendor');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
        ];
    }

    public function getGenderOptions()
    {
        return [
            self::GENDER_MALE => self::GENDER_MALE_LBL,
            self::GENDER_FEMALE => self::GENDER_FEMALE_LBL,
        ];
    }

}

?>