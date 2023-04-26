<?php
class Controller_Product extends Controller_Core_Action
{


	
	public function indexAction()
	{
		try {
			$layout = $this->getLayout();
			$this->_setTitle("Product");
			$index = $layout->createBlock('Core_Template');
			$layout->getChild("content")->addChild("index",$index);
			$layout->render();
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function gridAction()
	{
		try {
			$layout = $this->getLayout();
			$this->_setTitle("Product");
			$currentPage = $this->getRequest()->getParams("page");
			$gridHtml = $layout->createBlock('Product_Grid')->setData(["page"=>$currentPage])->toHtml();
			echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
			@header("Content-Type:application/json");
			
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}


	public function addAction()
	{
		try {

			$layout = $this->getLayout();
			$this->_setTitle("Add Product");
			$product = Ccc::getModel('product');
			$addHtml = $layout->createBlock('Product_Edit')->setData(['product' => $product])->toHtml();

			echo json_encode(["html"=>$addHtml,"element"=>"content-html"]);
			@header("Content-Type:application/json");
			
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	public function editAction()
	{
		try {
			if (!($productId = (int) $this->getRequest()->getParams('id'))) {
				throw new Exception("Invalid Request", 1);
			}

			$product = Ccc::getModel('product')->load($productId);
			if (!$product) {
				throw new Exception("Invalid id.", 1);
			}

			$layout = $this->getLayout();
			$editHtml = $layout->createBlock('product_edit')->setData(['product' => $product])->toHtml();

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
				throw new Exception("Invalid Request.", 1);
			}

			$postData = $this->getRequest()->getPost('product');
			if (!$postData) {
				throw new Exception("Invalid data posted.", 1);
			}

			if ($productId = (int) $this->getRequest()->getParams('id')) {
				$product = Ccc::getModel('product')->load($productId);
				if (!$product) {
					throw new Exception("Invalid Id", 1);
				}

				$product->updated_at = date("Y-m-d H:i:s");
			} else {
				$product = Ccc::getModel('product');
				$product->created_at = date("Y-m-d H:i:s");
			}

			$product->setData($postData);
			if (!$product->save()) {
				throw new Exception("Error while saving the Product.", 1);
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
                    $model->getResource()->setTableName("product_{$backend_type}")->setPrimaryKey("value_id");
                    $sql = "INSERT INTO `product_{$backend_type}` (`entity_id`, `attribute_id`, `value`)
                            VALUES('{$product->getId()}', '{$attributeId}', '{$v}') ON DUPLICATE KEY UPDATE `value` = '{$v}'";

                    $model->getResource()->getAdapter()->insert($sql);
                }
            }
            
			$this->getMessageModel()->addMessage("Product data saved successfully.");
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}

			$layout = $this->getLayout();
			$this->_setTitle("Product");
			$gridHtml = $layout->createBlock('Product_Grid')->toHtml();
			echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
			@header("Content-Type:application/json");
	}

	public function deleteAction()
	{
		try {
			$productId = (int) $this->getRequest()->getParams('id');
			if (!$productId) {
				throw new Exception("Invalid Request.", 1);
			}

			$mediaRow = Ccc::getModel('Product_Media');
			$sql = "SELECT `image` FROM `{$mediaRow->getResource()->getTableName()}` WHERE `product_id` = '{$productId}';";
			$images = $mediaRow->fetchAll($sql);
			if($images){
				foreach ($images as $img) {
				unlink('View/media_images_uploaded/' . $img->image);
			}
			}
			$product = Ccc::getModel('product')->load($productId);
			if (!$product) {
				throw new Exception("Invalid Id", 1);
			}

			if (!$product->delete()) {
				throw new Exception("Error while deleting the Product.", 1);
			}

			$this->getMessageModel()->addMessage("Product deleted successfully.");
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($e->getMessage(), Model_Core_Message::FAILURE);
		}
		 	$layout = $this->getLayout();
			$this->_setTitle("Product");
			$gridHtml = $layout->createBlock('Product_Grid')->toHtml();
			echo json_encode(["html"=>$gridHtml,"element"=>"content-html"]);
			@header("Content-Type:application/json");
	}
}
?>