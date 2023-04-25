<?php
class Controller_Customer extends Controller_Core_Action
{

    public function indexAction()
    {
         try {
            $layout = $this->getLayout();
            $index = $this->getLayout()->createBlock('Core_Template');
            $layout->getChild('content')->addChild('index', $index);
            $layout->render();
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }
    public function gridAction()
    {
        try {
            $gridHtml = $this->getLayout()->createBlock('Customer_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }


    public function addAction()
    {
        try {
            $customer = Ccc::getModel('customer');
            $billingAddress = Ccc::getModel('customer_address');
            $shippingAddress = Ccc::getModel('customer_address');

            $layout = $this->getLayout();
            $addHtml = $layout->createBlock('Customer_Edit')
                ->setData(['customer' => $customer, 'billingAddress'=>$billingAddress, 'shippingAddress'=>$shippingAddress])->toHtml();
            $gridHtml = $this->getLayout()->createBlock('Customer_Grid')->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'customer', null, true);
        }
    }

    public function editAction()
    {
        try {
            $customerId = (int) $this->getRequest()->getParams('id');
            if (!$customerId) {
                throw new Exception("Invalid request.", 1);
            }

            $customer = Ccc::getModel('customer')->load($customerId);
            if (!$customer) {
                throw new Exception("Invalid id.", 1);
            }

            $billingAddress = $customer->getBillingAddress();
            if(!$billingAddress){
                $billingAddress = Ccc::getModel('customer_address');
            }

            $shippingAddress = $customer->getShippingAddress();
            if(!$shippingAddress){
                $shippingAddress = Ccc::getModel('customer_address');
            }

            $layout = $this->getLayout();
            $edit = $layout->createBlock('Customer_Edit')
                ->setData(['customer' => $customer, 'billingAddress' => $billingAddress, 'shippingAddress'=>$shippingAddress]);
             $editHtml = $layout->createBlock('Customer_Edit')
                ->setData(['customer' => $customer, 'billingAddress'=>$billingAddress, 'shippingAddress'=>$shippingAddress])->toHtml();
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");


        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'customer', null, true);
        }
    }

    public function addressAction()
    {
        try {
            $customerId = (int) $this->getRequest()->getParams('id');
            if (!$customerId) {
                throw new Exception("Invalid request.", 1);
            }

            $customer = Ccc::getModel('customer');
            $address = Ccc::getModel('customer_address')->load($customerId, $customer->getResource()->getPrimaryKey());
            if (!$address) {
                throw new Exception("Invalid id.", 1);
            }

            $layout = $this->getLayout();
            $edit = $layout->createBlock('Customer_Address_Show')->setData(['address' => $address]);
            
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'customer', null, true);
        }
    }

    protected  function _saveCustomer()
    {
        if (!$customerPostData = $this->getRequest()->getPost('customer')) {
                throw new Exception("Data is not posted.", 1);
            }   

        if ($customerId = $this->getRequest()->getParams('id')) {
            if (!$customer = Ccc::getModel('Customer')->load($customerId))
            {
                throw new Exception("Invalid id.", 1);
            }
            $customer->updated_at = date("Y-m-d h:i:s");
        }  
        else 
        {
            $customer = Ccc::getModel('Customer');
            $customer->created_at = date("Y-m-d h:i:s");
        }

        $customer->setData($customerPostData);
        if (!$customer = $customer->save()) {
            throw new Exception("Unable to save the customer information.", 1);
        }
        return $customer;
    }

    protected function _saveBillingAddress($customer)
    {
        if (!$billingPostData = $this->getRequest()->getPost('billing')) {
            throw new Exception("Billing data is not posted.", 1);
        }
        
        
        $billingAddress = $customer->getBillingAddress();

        if(!$billingAddress){
            $billingAddress = Ccc::getModel("Customer_Address");
            $billingAddress->customer_id = $customer->getId();
        }

        $billingAddress->setData($billingPostData);
        if(!$billingAddress->save()){
            throw new Exception("Unable to save billing address.", 1);
        }
        return $billingAddress;
    }

    protected function _saveShippingAddress($customer)
    {
        if (!($shippingPostData = $this->getRequest()->getPost('shipping'))) {
                throw new Exception("Shipping data is not postted.", 1);
        }

        $shippingAddress = $customer->getShippingAddress();
        if(!$shippingAddress){
            $shippingAddress = Ccc::getModel("Customer_Address");
            $shippingAddress->customer_id = $customer->getId();
        }

        $shippingAddress->setData($shippingPostData);
        if(!$shippingAddress->save()){
            throw new Exception("Unable to save the shipping address.", 1);
        }
        return $shippingAddress;
    }

    public function saveAction()
    {

        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid request.", 1);
                
            }
            $customer = $this->_saveCustomer();

            $billingAddress = $this->_saveBillingAddress($customer);
            $customer->billing_address_id=$billingAddress->getId();

            $customer->removeData('updated_at');
            $shppingAddress = $this->_saveShippingAddress($customer);
            $customer->shipping_address_id=$shppingAddress->getId();

            if(!$customer->save()){
                throw new Exception("Error while saving the customer information.", 1);
            }

            $this->getMessageModel()->addMessage("New customer information save successfully.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
        $gridHtml = $this->getLayout()->createBlock('Customer_Grid')->toHtml();
        echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
        @header("Content-Type:application/json");
    }

    public function deleteAction()
    {

        try {
            $customerId = (int) $this->getRequest()->getParams('id');
            if (!$customerId) {
                throw new Exception("Invalid request.", 1);
            }

            $customer = Ccc::getModel('customer')->load($customerId);
            if (!$customer->delete()) {
                throw new Exception("Unable to delete the customer details.", 1);
            }

            $this->getMessageModel()->addMessage("Customer information has been deleted successfully.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }

        $gridHtml = $this->getLayout()->createBlock('Customer_Grid')->toHtml();
        echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
        @header("Content-Type:application/json");
    }
}
?>