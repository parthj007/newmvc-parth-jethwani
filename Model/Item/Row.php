<?php
/**
 * 
 */
class Model_Vendor_Row extends Model_Core_Table_Row
{
	public $tableClass = 'Vendor';

    public function getStatusText()
    {
        $statues = $this->getTable()->getStatusOptions();
        if (array_key_exists($this->status,$statues)) {
            return $statues[$this->status];
        }
        return $statues[Model_Product::STATUS_DEFAULT];
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Product::STATUS_DEFAULT;
    }
}