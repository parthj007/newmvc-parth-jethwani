<?php

class Model_Vendor extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Vendor_Collection');
        $this->setResourceClass('Model_Vendor_Resource');
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }

        return Model_Vendor_Resource::STATUS_DEFAULT;
    }

    public function getGender()
    {
        if ($this->gender) {
            return $this->gender;
        }

        return Model_Vendor_Resource::GENDER_MALE;
    }

    public function getGenderText()
    {
        $genders = $this->getResource()->getGenderOptions();
        if (array_key_exists($this->gender, $genders)) {
            return $genders[$this->gender];
        }
        return $genders[Model_Vendor_Resource::GENDER_MALE];
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Vendor_Resource::STATUS_DEFAULT];
    }

}

?>