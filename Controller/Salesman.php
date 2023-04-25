<?php
class Controller_Salesman extends Controller_Core_Action
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
        }
    }

    public function gridAction()
    {
        try {
            $gridHtml = $this->getLayout()->createBlock('Salesman_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);    
            @header("Content-Type:application/json");

        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }
    public function editAction()
    {
        try {
            $salesmanId = (int) $this->getRequest()->getParams('id');
            if (!$salesmanId) {
                throw new Exception("Invalid request.", 1);
            }

            $salesman = Ccc::getModel('salesman')->load($salesmanId);
            if (!$salesman) {
                throw new Exception("Invalid id.", 1);
            }

            $address = Ccc::getModel('salesman_address')->load($salesmanId, 'salesman_id');
            if (!$address) {
                throw new Exception("Invalid id.", 1);
            }
            $editHtml =$this->getLayout()->createBlock('Salesman_Edit')->setData(['salesman' => $salesman, 'address' => $address])->toHtml();
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }
    public function addAction()
    {
        try {
            $salesman = Ccc::getModel('salesman');
            $address = Ccc::getModel('salesman_address');
            $addHtml =$this->getLayout()->createBlock('Salesman_Edit')
            ->setData(['salesman' => $salesman, 'address' => $address])->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function deleteAction()
    {
        try {
            $salesmanId = (int) $this->request->getParams('id');
            if (!$salesmanId) {
                throw new Exception("Invalid request.", 1);
            }

            $salesman = Ccc::getModel('salesman')->load($salesmanId);
            if (!$salesman) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$salesman->delete()) {
                throw new Exception("Salesman has been deleted successfully.", 1);
            }

            $this->getMessageModel()->addMessage("Saleman information deleted successfully.");
            $gridHtml = $this->getLayout()->createBlock('Salesman_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);    
            @header("Content-Type:application/json");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }

    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $salesmanPostData = $this->getRequest()->getPost('salesman');
            $addressPostData = $this->getRequest()->getPost('address');
            if (!$salesmanPostData && !$addressPostData) {
                throw new Exception("No data is posted.", 1);
            }

            if ($id = $this->getRequest()->getParams('id')) {
                $salesman = Ccc::getModel('salesman')->load($id);
                $address = Ccc::getModel('salesman_address')
                ->load($id, $salesman->getResource()->getPrimaryKey());
                if (!$salesman || !$address) {
                    throw new Exception("Invalid id.", 1);
                }
                $salesman->updated_at = date('Y-m-d H:i:s');
            } else {
                $salesman = Ccc::getModel('salesman');
                $address = Ccc::getModel('salesman_address');
                $salesman->created_at = date('Y-m-d H:i:s');
            }

            $salesman->setData($salesmanPostData);
            if (!$salesman->save()) {
                throw new Exception("Unable to save salesman information.", 1);
            }

            $address->setData($addressPostData);
            $address->salesman_id = $salesman->salesman_id;
            if (!$address->save()) {
                throw new Exception("Unable to save salesman address information.", 1);
            }

            $this->getMessageModel()->addMessage("New salesman information has been saved successfully.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
            $gridHtml = $this->getLayout()->createBlock('Salesman_Grid')->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);    
            @header("Content-Type:application/json");
    }
}

?>