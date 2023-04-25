<?php

class Model_Quote extends Model_Core_Table
{

    protected $quote = null;

    public function __construct()
    {
        parent::__construct();
        $this->setCollectionClass("Model_Quote_Collection");
        $this->setResourceClass("Model_Quote_Resource");
    }

    public function loadQuote()
    {
        $quote=null;
        if($customerId = Ccc::getModel("Core_Session")->get("customer_id")){
            $quote = Ccc::getModel("quote")->load($customerId,"customer_id");
        }
        else{
        $quote = Ccc::getModel("quote");
        }
        return $quote;
    }

    public function getCustomer()
    {
        return Ccc::getModel("customer")->load($this->customer_id,"customer_id");
    }
    public function getBillingAddress()
    {
        if($quoteAddress=Ccc::getModel("quote_address")->load($this->quote_billing_id)){
            return $quoteAddress;
        }
        if($this->quote_billing_id == 0){
            if($customer = Ccc::getModel("customer")->load($this->customer_id)){
                $address = $customer->getBillingAddress();    
                if(!$address){
                    return Ccc::getModel("quote_Address");
                }
                return $address;
            }
        }
        
    }
    public function getShippingAddress()
    {
        if($quoteAddress=Ccc::getModel("quote_address")->load($this->quote_shipping_id)){
            return $quoteAddress;
        }
        if($this->quote_shipping_id == 0){
            if($customer = Ccc::getModel("customer")->load($this->customer_id)){
                $address = $customer->getShippingAddress();    
                if(!$address){
                    return Ccc::getModel("quote_Address");
                }
                return $address;
            }
        }
    }

    public function getStatus()
    {
        if ($this->status) {
            return $this->status;
        }
        return Model_Quote_Resource::STATUS_DEFAULT;
    }

    public function getStatusText()
    {
        $statuses = $this->getResource()->getStatusOptions();
        if (array_key_exists($this->status, $statuses)) {
            return $statuses[$this->status];
        }
        return $statuses[Model_Customer_Resource::STATUS_DEFAULT];
    }
}

?>