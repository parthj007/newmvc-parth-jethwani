<?php

class Controller_Payment_Method extends Controller_Core_Action
{

    public function indexAction()
    {
        try {
            $layout=$this->getLayout();
            $index = $layout->createBlock("Core_Template");
            $layout->getChild("content")->addChild("index",$index);
            $layout->render();    
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
        
    }
    public function gridAction()
    {
        try {
            $gridHtml = $this->getLayout()->createBlock('Payment_Method_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
            
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $paymentMethod = Ccc::getModel('payment_method');
            $addHtml = $this->getLayout()->createBlock('Payment_Method_Edit')->setData(['paymentMethod' => $paymentMethod])->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'payment_method', null, true);
        }
    }

    public function editAction()
    {
        try {
            $id = (int) $this->getRequest()->getParams('id');
            if (!$id) {
                throw new Exception("Invalid request", 1);
            }

            $paymentMethod = Ccc::getModel('payment_method')->load($id);
            if (!$paymentMethod) {
                throw new Exception("Invalid id.", 1);
            }
            $editHtml = $this->getLayout()->createBlock('Payment_Method_Edit')->setData(['paymentMethod' => $paymentMethod])->toHtml();
             echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'payment_method', null, true);
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $postData = $this->getRequest()->getPost('paymentMethod');
            if (!$postData) {
                throw new Exception("Data is not posted.", 1);
            }

            if ($id = $this->getRequest()->getParams('id')) {
                $paymentMethod = Ccc::getModel('payment_method')->load($id);
                if (!$paymentMethod) {
                    throw new Exception("Invalid id.", 1);
                }
                $paymentMethod->updated_at = date('Y-m-d H:i:s');
            } else {
                $paymentMethod = Ccc::getModel('payment_method');
                $paymentMethod->created_at = date('Y-m-d H:i:s');
            }

            $paymentMethod->setData($postData);
            if (!$paymentMethod->save()) {
                throw new Exception("Unable to save the payment method.", 1);
            }

            $this->getMessageModel()->addMessage("Payment method has been saved successfully.");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
            $gridHtml = $this->getLayout()->createBlock('Payment_Method_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->getRequest()->getParams('id');
            if (!$id) {
                throw new Exception("Invalid request", 1);
            }

            $paymentMethod = Ccc::getModel('payment_method')->load($id);
            if (!$paymentMethod) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$paymentMethod->delete()) {
                throw new Exception("Unable to delete the payment method.", 1);
            }

            $this->getMessageModel()->addMessage("Payment method has been deleted successfully.");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
            $gridHtml = $this->getLayout()->createBlock('Payment_Method_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }
}

?>