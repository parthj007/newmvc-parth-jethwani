<?php
class Controller_Admin extends Controller_Core_Action
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
            $gridHtml = $this->getLayout()->createBlock('Admin_Grid')->toHtml();

            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $admin = Ccc::getModel('admin');
            $addHtml = $this->getLayout()->createBlock('Admin_Edit')->setData(['admin' => $admin])->toHtml();
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function editAction()
    {
        try {
            if (!($id = (int) $this->getRequest()->getParams('id'))) {
                throw new Exception("Invalid Id", 1);
            }

            $admin = Ccc::getModel('admin')->load($id);
            if (!$admin) {
                throw new Exception("Invalid Id", 1);
            }

            $layout = $this->getLayout();
            $editHtml = $this->getLayout()->createBlock('Admin_Edit')->setData(['admin' => $admin])->toHtml();
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
            

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }



    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request", 1);
            }

            $postData = $this->getRequest()->getPost('admin');
            if (!$postData) {
                throw new Exception("Invalid data posted.", 1);
            }

            if ($id = (int) $this->getRequest()->getParams('id')) {
                $admin = Ccc::getModel('admin')->load($id);
                if (!$admin) {
                    throw new Exception("Invalid Id", 1);
                }

                $admin->updated_at = date('Y-m-d H:i:s');
            } else {
                $admin = Ccc::getModel('admin');
                $admin->created_at = date('Y-m-d H:i:s');
            }

            $admin->setData($postData);
            if (!$admin->save()) {
                throw new Exception("Unable to save admin.", 1);
            }

            $this->getMessageModel()->addMessage("Admin has been saved successfully.", Model_Core_Message::SUCCESS);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
         $gridHtml = $this->getLayout()->createBlock('Admin_Grid')->toHtml();

            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }

    public function deleteAction()
    {
        try {
            if (!($id = (int) $this->getRequest()->getParams('id'))) {
                throw new Exception("Invalid request.", 1);
            }

            $admin = Ccc::getModel('admin')->load($id);
            if (!$admin) {
                throw new Exception("Invalid Id.", 1);
            }

            if (!$admin->delete()) {
                throw new Exception("Unable to delete the admin.", 1);
            }

            $this->getMessageModel()->addMessage("Admin deleted successfully.", Model_Core_Message::SUCCESS);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
        $gridHtml = $this->getLayout()->createBlock('Admin_Grid')->toHtml();

            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }
}

?>