<?php

class Controller_Item extends Controller_Core_Action
{
    public function gridAction()
    {
        try {
            $layout = $this->getLayout();
            $grid = $layout->createBlock('item_grid');
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
            $item = Ccc::getModel('item');
            $edit = $layout->createBlock('Item_Edit')->setData(['row' => $item]);
            $layout->getChild('content')->addChild('edit', $edit);
            $layout->render();
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function saveAction()
    {
        try{
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid request.", 1);
            }          

            $itemDataPost = $this->getRequest()->getPost('item');
            if(!$itemDataPost){
                throw new Exception("Item data is not posted.", 1);
            }

            if($itemId = $this->getRequest()->getParams('id')){
                $item = Ccc::getModel('item')->load($itemId);
                $item->updated_at = date('Y-m-d H:i:s');

            }else{
                $item = Ccc::getModel('item');
                $item->created_at = date('Y-m-d H:i:s');
            }

            $item->setData($itemDataPost);
            if(!$item->save()){
                throw new Exception("Unable to save item.", 1);
            }

            if(!$attributePostData = $this->getRequest()->getPost('attribute')){
                throw new Exception("Attribute data is not posted.", 1);
            }
        
            foreach($attributePostData as $backend_type => $value){
                foreach($value as $attributeId => $v){
                    if(is_array($v)){
                        $v = implode(",", $v);
                    }

                    $model = Ccc::getModel("core_table");
                    $model->getResource()->setTableName("item_{$backend_type}")->setPrimaryKey("value_id");
                $sql = "INSERT INTO `item_{$backend_type}` (`entity_id`, `attribute_id`, `value`)
                            VALUES('{$item->getId()}', '{$attributeId}', '{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

                    $model->getResource()->getAdapter()->insert($sql);
                }
            }

            $this->getMessageModel()->addMessage("Item record has been saved successfully.");
            $this->redirect('grid',null,null,true);
        }catch(Exception $e){
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid',null,null,true);
        }
    }

    public function editAction()
    {
        try{ 
            if(!$itemId = $this->getRequest()->getParams('id')){
                throw new Exception("Invalid request.", 1);
            }

            if(!$item = Ccc::getModel('item')->load($itemId)){
                throw new Exception("Invalid id.", 1);
            }   
            $layout = $this->getLayout();
            $edit = $layout->createBlock('item_edit')->setData(['row'=>$item]);
            $layout->getChild('content')->addChild('edit', $edit);
            $layout->render();

        }catch(Exception $e){
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', null, null, true);
        }
    }

    public function deleteAction()
    {
        try{
            if(!$itemId = $this->getRequest()->getParams('id')){
                throw new Exception("Invalid request.", 1);
            }

            if(!$item = Ccc::getModel('item')->load($itemId)){
                throw new Exception("Invalid id.", 1);
            }

            if(!$item->delete()){
                throw new Exception("Unable to delete the item.", 1);
            }

            $this->getMessageModel()->addMessage("Item record has been deleted successfully.");
        }catch(Exception $e){
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
        $this->redirect('grid',null,null,true);
    }
}

?>