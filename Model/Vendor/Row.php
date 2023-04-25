<?php

class Model_Vendor_Row extends Model_Core_Table_Row
{
    public function __construct()
    {
        parent::__construct();
        $this->setTableClass('Model_Vendor');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }

        return Model_Vendor::STATUS_DEFAULT;
    }

    public function getGender()
    {
        if ($this->gender) {
            return $this->gender;
        }

        return Model_Vendor::GENDER_MALE;
    }

}

?>