<?php

class Controller_Eav_Attribute extends Controller_Core_Action
{

    public function indexAction()
    {
        $layout = $this->getLayout();
        $index = $layout->createBlock('Core_Template');
        $layout->getChild('content')->addChild('index', $index);
        $layout->render();
    }

    public function gridAction()
    {
        try {
            $gridHtml = $this->getLayout()->createBlock("Eav_Attribute_Grid")->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (\Throwable $th) {
            $this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
        }
    }

    public function addAction()
    {
        try {
            $attribute = Ccc::getModel('eav_attribute');
            $entity = Ccc::getModel('entity_type');
            $options = Ccc::getModel('eav_attribute_option');
            $sql = "SELECT * FROM `{$entity->getResource()->getTableName()}`";
            $entities = $entity->fetchAll($sql);
            $addHtml = $this->getLayout()->createBlock('Eav_Attribute_Edit')->setData(['attribute' => $attribute, 'options' => $options, 'entities' => $entities])->toHtml();

            echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid',null, null, true);
        }
    }

    public function editAction()
    {
        try {

            if (!$id = $this->getRequest()->getParams('id')) {
                throw new Exception("Invalid request.", 1);
            }

            if (!$attribute = Ccc::getModel('Eav_attribute')->load($id)) {
                throw new Exception("Invalid id.", 1);
            }

            $option = Ccc::getModel('eav_attribute_option');
            $sql = "SELECT * FROM `{$option->getResource()->getTableName()}` WHERE `attribute_id` = {$id}";
            $options = $option->fetchAll($sql);
            
            $entity = Ccc::getModel('entity_type');
            $sql = "SELECT * FROM `{$entity->getResource()->getTableName()}`";
            $entities = $entity->fetchAll($sql);

            $editHtml = $this->getLayout()->createBlock('Eav_Attribute_Edit')
                ->setData(['attribute' => $attribute, 'options' => $options, 'entities' => $entities])->toHtml();
            
            echo json_encode(["html"=>$editHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");

        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
            $this->redirect('grid', 'eav_attribute', null, true);
        }
    }

    public function saveAction()
    {
        try {
            if (!$this->getRequest()->isPost()) {
                throw new Exception("Invalid request.", 1);
            }

            $attributePostData = $this->getRequest()->getPost('attribute');
            if ($id = $this->getRequest()->getParams('id')) {
                if (!$attribute = Ccc::getModel('Eav_attribute')->load($id)) {
                    throw new Exception("Invalid id.", 1);
                }

            } else {
                $attribute = Ccc::getModel('Eav_attribute');
            }

            $attribute->setData($attributePostData);
            if (!$attribute->save()) {
                throw new Exception("Unable to save the attribute.", 1);
            }

            $optionsData = $this->getRequest()->getPost('options');
            $positionData = $this->getRequest()->getPost('positions');

            $sql = "SELECT * FROM `eav_attribute_option` WHERE `attribute_id`= '{$attribute->getId()}'";
            $oldOptions = Ccc::getModel('eav_attribute_option')->fetchAll($sql);

            if($optionsData){
                if(array_key_exists('exists',$optionsData)){
                    foreach($oldOptions->getData() as $oldOption){
                        if(array_key_exists($oldOption->getId(), $optionsData['exists'])){
                            $option = Ccc::getModel('eav_attribute_option')->load($oldOption->getId());
                            $option->name = $optionsData['exists'][$oldOption->getId()];
                            $option->position = $positionData['exists'][$oldOption->getId()];
                            if(!$option->save()){
                                throw new Exception("Unable to updated existing option.", 1);
                            }
                        }else{
                            if(!$oldOption->delete()){
                                throw new Exception("Unable to delete the existing option.", 1);
                            }
                        }   
                    }
                }elseif(!array_key_exists('exists', $optionsData) && $oldOptions){
                    foreach($oldOptions->getData() as $option){
                        if(!$option->delete()){
                            throw new Exception("Unable to delete the old option.", 1);
                        }
                    }
                }

                if(array_key_exists('new', $optionsData)){
                    foreach($optionsData['new'] as $key => $optionName){
                        $option = Ccc::getModel('eav_attribute_option');
                        $option->name = $optionName;
                        $option->attribute_id = $attribute->getId();
                        $option->position = $positionData['new'][$key];
                        if(!$option->save()){
                            throw new Exception("Unable to save new option.", 1);
                        }
                    }
                }
            }else{
                if($oldOptions){
                    foreach($oldOptions->getData() as $oldOption){
                        if(!$oldOption->delete()){
                            throw new Exception("Unable to delete the existing option.", 1);
                        }
                    }
                }
            }

            
            $this->getMessageModel()->addMessage('Attribute has been saved successfully.');
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
            $gridHtml = $this->getLayout()->createBlock("Eav_Attribute_Grid")->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }

    public function deleteAction()
    {
        try {
            if (!$id = $this->getRequest()->getParams('id')) {
                throw new Exception("Invalid request.", 1);
            }

            if (!$attribute = Ccc::getModel('Eav_attribute')->load($id)) {
                throw new Exception("Invalid id.", 1);
            }

            if (!$attribute->delete()) {
                throw new Exception("Unable to delete the attribute.", 1);
            }

            $this->getMessageModel()->addMessage('Attribute has been deleted successfully.');
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
        }
            $gridHtml = $this->getLayout()->createBlock("Eav_Attribute_Grid")->toHtml();
            echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
            @header("Content-Type:application/json");
    }
}