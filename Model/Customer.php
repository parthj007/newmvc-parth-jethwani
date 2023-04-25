<?php

class Model_Customer extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass("Model_Customer_Collection");
        $this->setResourceClass("Model_Customer_Resource");
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Customer_Resource::STATUS_DEFAULT;
    }

    public function getGenderText()
    {
        $genderArr = ['1' => 'Male', '2' => 'Female'];
        if (array_key_exists($this->gender, $genderArr)) {
            return $genderArr[$this->gender];
        }
        return $genderArr[1];
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Customer_Resource::STATUS_DEFAULT];
    }


    public function getShippingAddress()
    {
        if($this->shipping_address_id){
            return  Ccc::getModel('customer_address')->load($this->shipping_address_id);
        }
        return false;
    }

    public function getBillingAddress()
    {
        if($this->billing_address_id){
            return Ccc::getModel('customer_address')->load($this->billing_address_id);
        }
        return false;
    }
}

?>