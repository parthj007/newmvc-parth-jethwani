<?php

class Model_Shipping_Method extends Model_Core_Table
{
    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass("Model_Shipping_Method_Collection");
        $this->setResourceClass("Model_Shipping_Method_Resource");
    }


    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Shipping_Method_Resource::STATUS_DEFAULT];
    }


    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Shipping_Method_Resource::STATUS_DEFAULT;
    }
}

?>