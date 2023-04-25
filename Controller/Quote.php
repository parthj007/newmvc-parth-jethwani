<?php
class Controller_Quote extends Controller_Core_Action
{
    public function newAction()
    {
        $layout = $this->getLayout();
        $grid = $this->getLayout()->createBlock('Quote_Grid');
        $layout->getChild('content')->addChild('grid', $grid);
        $layout->render();
    }
     public function prepareQuoteAction()
    {
        try {
                $customerId = $this->getRequest()->getPost("customer");
                $this->getSessions()->set("customer_id",$customerId);

                if(!$quote = Ccc::getModel("quote")->load($customerId,"customer_id"))
                {
                $quote = Ccc::getModel("quote");
                $quote->customer_id = $customerId;
                $quote->quote_billing_id = $customer->billing_address_id;
                $quote->quote_shipping_id = $customer->shipping_address_id;
                $quote->created_at = date("Y-m-d H:i:s");
                    if(!$quote->save()){
                        throw new Exception("Error Processing Request", 1);
                    }
                    print_r($quote);
                }
                $this->redirect("new",null,null,null);
            }
            catch (Exception $e) {
                $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            }
    }

    public function saveBillingAddress($quote)
    {
        $billingAddress = Ccc::getModel("quote_address");
        $billingData = $this->getRequest()->getPost('billing');
        if($quote->quote_billing_id != 0){
            $billingAddress = $billingAddress->load($quote->quote_billing_id);
            $billingAddress->customer_id = $quote->customer_id;
            $billingAddress->updated_at = date("Y-m-d H:i:s");
        }
        else{
            $billingAddress->customer_id = $quote->customer_id;
            $billingAddress->created_at =  date("Y-m-d H:i:s");
        }
        $billingAddress->setData($billingData);
        if(!$billingAddress->save()){
            throw new Exception("Error Processing Request billing", 1);
        }
        else{
            return $billingAddress;
        }

    }

     public function saveShippingAddress($quote)
    {
        $shippingAddress = Ccc::getModel("quote_address");
        $shippingData = $this->getRequest()->getPost('shipping');
        if($quote->quote_shipping_id != 0){
            $shippingAddress = Ccc::getModel("quote_address")->load($quote->quote_shipping_id);
            $shippingAddress->customer_id = $quote->customer_id;
            $shippingAddress->updated_at = date("Y-m-d H:i:s");
        }
        else{
            $shippingAddress->customer_id = $quote->customer_id;
            $shippingAddress->created_at =  date("Y-m-d H:i:s");
        }
        $shippingAddress->setData($shippingData);
        if(!$shippingAddress->save()){
            throw new Exception("Error Processing Request shipping", 1);
        }
        else{
        return $shippingAddress;   
        }
    }


    public function saveAddressAction()
    {
        try {
            $quote = Ccc::getModel("quote")->loadQuote();
            $billingAddress = $this->saveBillingAddress($quote);
            $quote->quote_billing_id = $billingAddress->getId();
            if($this->getRequest()->getPost('checkbox1')){
                $billingAddress = $this->saveBillingAddress($quote);
                $quote->quote_shipping_id = $billingAddress->getId();
            }
            else{
                 $shippingAddress = $this->saveShippingAddress($quote);
                 $quote->quote_shipping_id = $shippingAddress->getId();
            }
            $quote->save();

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }
}
?>