<?php

class Controller_Shipping_Method extends Controller_Core_Action
{

    public function indexAction()
    {
        try {
            $layout = $this->getLayout();
            $index = $layout->createBlock('Core_Template');
            $layout->getChild('content')->addChild('index', $index);
            $layout->render();
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'shipping_method', null, true);
        }   
    }

    public function gridAction()
    {
        try {
            $layout = $this->getLayout();
            $gridHtml = $layout->createBlock('Shipping_Method_Grid')->toHtml();
            echo json_encode(['html'=>$gridHtml,'element'=>'content-html']);
            @header('Content-Type:application/json');
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'shipping_method', null, true);
        }
    }

    public function addAction()
    {
        try {
            $shippingMethod = Ccc::getModel('shipping_method');
            $layout = $this->getLayout();
            $addHtml = $layout->createBlock('Shipping_Method_Edit')->setData(['shippingMethod' => $shippingMethod])->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header('Content-Type:application/json');


        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'shipping_method', null, true);
        }
    }

    public function editAction()
    {
        try {
            $id = (int) $this->getRequest()->getParams('id');
            if (!$id) {
                throw new Exception("Invalid request.", 1);
            }

            $shippingMethod = Ccc::getModel('shipping_method')->load($id);
            if (!$shippingMethod) {
                throw new Exception("Invalid id.", 1);
            }

            $layout = $this->getLayout();
            $editHtml = $layout->createBlock('Shipping_Method_Edit')->setData(['shippingMethod' => $shippingMethod])->toHtml();

            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header('Content-Type:application/json');
            

        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'shipping_method', null, true);
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $postData = $this->getRequest()->getPost('shippingMethod');
            if (!$postData) {
                throw new Exception("Data is not posted.", 1);
            }

            if ($id = (int) $this->getRequest()->getParams('id')) {
                $shippingMethod = Ccc::getModel('shipping_method')->load($id);
                if (!$shippingMethod) {
                    throw new Exception("Invalid id.", 1);
                }
                $shippingMethod->updated_at = date('Y-m-d H:i:s');
            } else {
                $shippingMethod = Ccc::getModel('shipping_method');
                $shippingMethod->created_at = date('Y-m-d H:i:s');
            }

            $shippingMethod->setData($postData);
            if (!$shippingMethod->save()) {
                throw new Exception("Unable to save the shipping method.", 1);
            }

            $this->getMessageModel()->addMessage("Shipping method has been saved successfully.");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

            $layout = $this->getLayout();
            $gridHtml = $layout->createBlock('Shipping_Method_Grid')->toHtml();
            echo json_encode(['html'=>$gridHtml,'element'=>'content-html']);
            @header('Content-Type:application/json');
    }

    public function deleteAction()
    {
        try {
            $id = (int) $this->request->getParams('id');
            if (!$id) {
                throw new Exception("Invalid request.", 1);
            }

            $shippingMethod = Ccc::getModel('shipping_method')->load($id);
            if (!$shippingMethod) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$shippingMethod->delete()) {
                throw new Exception("Unable to delete the Shipping method.", 1);
            }

            $this->getMessageModel()->addMessage("Shipping method deleted successfully.");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
            $layout = $this->getLayout();
            $gridHtml = $layout->createBlock('Shipping_Method_Grid')->toHtml();
            echo json_encode(['html'=>$gridHtml,'element'=>'content-html']);
            @header('Content-Type:application/json');    }
}


?>