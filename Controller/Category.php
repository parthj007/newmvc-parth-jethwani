<?php
class Controller_Category extends Controller_Core_Action
{
    public function indexAction()
    {   
        try {
            $layout = $this->getLayout();
            $index = $layout->createBlock('Core_Template');
            $layout->getChild('content')->addChild('index', $index);
            $layout->render();
        }
        catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function gridAction()
    {
        try {
            $gridHtml = $this->getLayout()->createBlock("Category_Grid")->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $category = Ccc::getModel('category');
            $pathCategories = $category->preparePathCategories();
            $layout = $this->getLayout();
            $addHtml = $layout->createBlock('Category_Edit')->setData(['category' => $category, 'pathCategories' => $pathCategories])->toHtml();
            
            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }


    public function editAction()
    {
        try {
            $categoryId = (int) $this->getRequest()->getParams('id');
            if (!$categoryId) {
                throw new Exception("Invalid request.", 1);
            }

            $category = Ccc::getModel('category')->load($categoryId);
            if (!$category) {
                throw new Exception("Invalid id.", 1);
            }

            $parentForEdit = $category->getParentCategories();
            foreach ($parentForEdit as $id => $path) {
                if (strpos($path, $category->path)) {
                    unset($parentForEdit[$id]);
                }
            }


            $parentForEdit = $category->preparePathCategories($parentForEdit);
            $layout = $this->getLayout();
            $editHtml = $layout->createBlock('Category_Edit')->setData(['category' => $category, 'pathCategories' => $parentForEdit])->toHtml();
           
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'category', null, true);
        }
    }

    public function deleteAction()
    {
        try {
            $categoryId = (int) $this->getRequest()->getParams('id');
            if (!$categoryId) {
                throw new Exception("Invalid request.", 1);
            }

            $category = Ccc::getModel('category')->load($categoryId);
            if (!$category) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$category->deleteWithChild()) {
                throw new Exception("Unable to delete category.", 1);
            }

            $this->getMessageModel()->addMessage("Category has been deleted successfully.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
        $gridHtml = $this->getLayout()->createBlock("Category_Grid")->toHtml();
        echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
        @header("Content-Type:application/json");
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid Request.", 1);
            }

            $postData = $this->getRequest()->getPost('category');
            if (!$postData) {
                throw new Exception("No Data Posted.", 1);
            }

            if ($categoryId = (int) $this->getRequest()->getParams('id')) {
                $category = Ccc::getModel('category')->load($categoryId);
                if (!$category) {
                    throw new Exception("Invalid id.", 1);
                }
                $category->updated_at = date('Y-m-d H:i:s');
            } else {
                $category = Ccc::getModel('category');
                $category->created_at = date('Y-m-d H:i:s');
            }

            $category = $category->setData($postData);
            if (!$category->save()) {
                throw new Exception("Unable to save category.", 1);
            }

            $category->updatePath();
            $this->getMessageModel()->addMessage("Category has beed saved successfully.");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
        $gridHtml = $this->getLayout()->createBlock("Category_Grid")->toHtml();
        echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
        @header("Content-Type:application/json");
    }
}
?>