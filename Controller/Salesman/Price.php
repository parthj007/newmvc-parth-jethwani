<?php 
/**
 * 
 */
class Controller_Salesman_Price extends Controller_Core_Action
{
    public function gridAction()
    {
        try {
            if (!$salesmanId = $this->getRequest()->getParams('id')) {
                throw new Exception("Invalid request.", 1);
            }
            
            $layout = $this->getLayout();
            $gridHtml = $layout->createBlock('Salesman_Price_Grid')->setData(['salesmanId'=>$salesmanId])->toHtml();
            $this->getResponse()->jsonResponse(['html'=>$gridHtml, 'element'=>'content-html']);
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getmessage(),Model_Core_Message::FAILURE);
            $this->redirect('grid','salesman',null,true);
        }
    }
    
    public function saveAction()
    {
        try {
            if(!$this->getRequest()->isPost()){
                throw new Exception("Invalid Request.", 1);
            }

            if(!$salesmanId = $this->getRequest()->getParams('id')){
                throw new Exception("Invalid request.", 1);
            }
            
            $productIds = $this->getRequest()->getPost('salesman');
            Ccc::log($productIds,"sp.log");
            foreach($productIds as $pid => $price){
                if($price){
                    $row['product_id'] = $pid;
                    $row['salesman_id'] = $salesmanId;
                    $row['salesman_price'] = $price;
                    $uniqueColumns = $row;
                    unset($uniqueColumns['salesman_id']);
                    unset($uniqueColumns['product_id']);
                    $salesmanPrice = Ccc::getModel('salesman_price');
                    $salesmanPrice->getResource()->insertUpdateOnDuplicate($row,$uniqueColumns);
                }
            }
            

            $this->getMessageModel()->addMessage('Price Updated Successfully..!!');
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getmessage(),Model_Core_Message::FAILURE);
        }
        $this->redirect('grid',null,['id'=>$salesmanId],true);
    }
    
    public function deleteAction()
    {
        try {
            if(!$id = $this->getRequest()->getParams('entity_id') OR !$salesmanId = $this->getRequest()->getParams('id')){
                throw new Exception("Invalid request", 1);
            }

            echo $id;
            $entity = Ccc::getModel('salesman_price')->load($id);

            if(!$entity->delete()){
                throw new Exception("Unable to delete the salesman price record.", 1);
            }

            $this->getMessageModel()->addMessage('Salesman price deleted successfully..!!');
        } catch (Exception $e) {
            $this->getMessageModel()->addMessage($e->getmessage(),Model_Core_Message::FAILURE);
        }
        $this->redirect('grid',null,['id'=>$salesmanId],true);
    }
}
?>