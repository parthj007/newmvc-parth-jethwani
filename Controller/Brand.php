<?php
class Controller_Brand extends Controller_Core_Action
{
    public function gridAction()
    {
        try {
            $layout = $this->getLayout()->setTemplate('core/layout/1column.phtml');
            $grid = $layout->createBlock('Brand_Grid');
            $layout->getChild('content')->addChild('grid', $grid);
            $layout->render();
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $layout = $this->getLayout();
            $brand = Ccc::getModel('brand');
            $edit = $layout->createBlock('Brand_Edit')->setData(['brand' => $brand]);
            $layout->getChild('content')->addChild('edit', $edit);
            echo $layout->toHtml();
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

            $brand = Ccc::getModel('brand')->load($id);
            if (!$brand) {
                throw new Exception("Invalid Id", 1);
            }

            $layout = $this->getLayout();
            $edit = $layout->createBlock('Brand_Edit')->setData(['brand' => $brand]);
            $layout->getChild('content')->addChild('edit', $edit);
            $layout->render();

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

            $postData = $this->getRequest()->getPost('brand');
            if (!$postData) {
                throw new Exception("Invalid data posted.", 1);
            }

            if ($id = (int) $this->getRequest()->getParams('id')) {
                $brand = Ccc::getModel('brand')->load($id);
                if (!$brand) {
                    throw new Exception("Invalid Id", 1);
                }

                $brand->updated_at = date('Y-m-d H:i:s');
            } else {
                $brand = Ccc::getModel('brand');
                $brand->created_at = date('Y-m-d H:i:s');
            }

            $brand->setData($postData);
            if (!$brand->save()) {
                throw new Exception("Unable to save brand.", 1);
            }

            $this->getMessageModel()->addMessage("Brand has been saved successfully.", Model_Core_Message::SUCCESS);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
        $this->redirect('grid', null, null, true);
    }

    public function deleteAction()
    {
        try {
            if (!($id = (int) $this->getRequest()->getParams('id'))) {
                throw new Exception("Invalid request.", 1);
            }

            $brand = Ccc::getModel('brand')->load($id);
            if (!$brand) {
                throw new Exception("Invalid Id.", 1);
            }

            if (!$brand->delete()) {
                throw new Exception("Unable to delete the brand.", 1);
            }

            $this->getMessageModel()->addMessage("Brand deleted successfully.", Model_Core_Message::SUCCESS);
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
        $this->redirect('grid', null, null, true);
    }
}

?>