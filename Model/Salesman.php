<?php

class Model_Salesman extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass('Model_Salesman_Collection');
        $this->setResourceClass('Model_Salesman_Resource');
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }

        return $statuses[Model_Salesman_Resource::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }

        return Model_Salesman_Resource::STATUS_DEFAULT;
    }

    public function getGender()
    {
        if($this->gender){
            return $this->gender;
        }
        return Model_Salesman_Resource::GENDER_MALE;
    }

    public function getGenderText()
    {
        $genders = $this->getResource()->getGenderOptions();
        if (array_key_exists($this->gender, $genders)) {
            return $genders[$this->gender];
        }

        return Model_Salesman_Resource::GENDER_MALE_LBL;
    }
}

?>