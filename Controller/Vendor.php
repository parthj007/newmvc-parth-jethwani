<?php

class Controller_Vendor extends Controller_Core_Action
{


    public function indexAction()
    {
        try {
            $layout = $this->getLayout();
            $index = $layout->createBlock('Core_Template');
            $layout->getChild('content')->addChild('index', $index);
            $layout->render();
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function gridAction()
    {
        try {
            $gridHtml =  $this->getLayout()->createBlock('Vendor_Grid')->toHtml();

            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header('Content-Type:applicatio/json');

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $vendor = Ccc::getModel('vendor');
            $address = Ccc::getModel('vendor_address');

            $layout = $this->getLayout();
            $addHtml = $layout->createBlock('Vendor_Edit')->setData(['vendor' => $vendor, 'address' => $address])->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header('Content-Type:applicatio/json');
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect("grid", 'vendor', null, true);
        }
    }

    public function editAction()
    {
        try {
            $vendorId = (int) $this->getRequest()->getParams('id');
            if (!$vendorId) {
                throw new Exception("Invalid request.", 1);
            }

            $vendor = Ccc::getModel('vendor')->load($vendorId);
            if (!$vendor) {
                throw new Exception("Invalid id.", 1);
            }

            $address = Ccc::getModel('vendor_address')->load($vendorId, 'vendor_id');
            if (!$address) {
                throw new Exception("Invalid id.", 1);
            }

            $layout = $this->getLayout();
            $editHtml = $layout->createBlock('Vendor_Edit')->setData(['vendor' => $vendor, 'address' => $address])->toHtml();
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header('Content-Type:applicatio/json');
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect("grid", 'vendor', null, true);
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $vendorPostData = $this->getRequest()->getPost('vendor');
            if (!$vendorPostData) {
                throw new Exception("Vendor data is not posted.", 1);
            }

            if ($id = $this->getRequest()->getParams('id')) {
                $vendor = Ccc::getModel('vendor')->load($id);
                if (!$vendor) {
                    throw new Exception("Invalid id.", 1);
                }
                $vendor->updated_at = date('Y-m-d H:i:s');
            } else {
                $vendor = Ccc::getModel('vendor');
                $vendor->created_at = date('Y-m-d H:i:s');
            }

            $vendor->setData($vendorPostData);
            if (!$vendor->save()) {
                throw new Exception("Unable to save the vendor information.", 1);
            }

            $address = Ccc::getModel('vendor_address');
            $addressPostData = $this->getRequest()->getPost('address');
            if (!$addressPostData) {
                throw new Exception("address data is not posted.", 1);
            }

            $address->setData($addressPostData);
            $address->vendor_id = $vendor->vendor_id;
            if (!$address->save()) {
                throw new Exception("Unable to save the address information.", 1);
            }

            $this->getMessageModel()->addMessage("Vendor information successfully inserted.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
        $gridHtml =  $this->getLayout()->createBlock('Vendor_Grid')->toHtml();
            
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header('Content-Type:applicatio/json');
    }



    public function deleteAction()
    {
        try {
            $vendorId = (int) $this->getRequest()->getParams('id');
            if (!$vendorId) {
                throw new Exception("Invalid request.", 1);
            }

            $vendor = Ccc::getModel('vendor')->load($vendorId);
            if (!$vendor) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$vendor->delete()) {
                throw new Exception("Unable to delete the vendor information.", 1);
            }

            $this->getMessageModel()->addMessage("Vendor information deleted successfully.");
           $gridHtml =  $this->getLayout()->createBlock('Vendor_Grid')->toHtml();
            
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header('Content-Type:applicatio/json');
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }
}


?>