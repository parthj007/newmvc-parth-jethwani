<?php

class Model_Paymentmethod_Row extends Model_Core_Table_Row
{
    function __construct()
    {
        parent::__construct();
        $this->setTableClass("Model_Paymentmethod");
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Paymentmethod::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getTable()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Paymentmethod::STATUS_DEFAULT];
    }
}

?>