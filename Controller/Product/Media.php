<?php


class Controller_Product_Media extends Controller_Core_Action
{

	public function indexAction()
	{
		try {
			$layout = $this->getLayout();
			$index = $layout->createBlock("Core_Template");
			$layout->getChild('content')->addChild("index",$index);
			$layout->render()
		} catch (Exception $e) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
			$this->redirect('grid', 'product', null, true);
		}
	}

	public function gridAction()
	{
		try {
			$productId = $this->getRequest()->getParams('pid');
			if (!$productId) {
				throw new Exception("Invalid request.", 1);
			}

			$product = Ccc::getModel('product');
			$sql = "SELECT * FROM `{$product->getResource()->getTableName()}` 
					WHERE `{$product->getResource()->getPrimaryKey()}`= '{$productId}'";
			$productName = $product->fetchRow($sql);
			if (!$productName) {
				throw new Exception("Product id is not valid.", 1);
			}

			$base = $product->getBase();
			$small = $product->getSmall();
			$thumb = $product->getThumb();

			$layout = $this->getLayout();
			$grid = $layout->createBlock('Product_Media_Grid')
				->setData([
					'productId' => $productId,
					'productName' => $productName,
					'base' => $base,
					'small' => $small,
					'thumb' => $thumb
				]);

			$layout->getChild('content')->addChild('grid', $grid);
			$layout->render();
		} catch (\Throwable $th) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
			$this->redirect('grid', 'product', null, true);
		}
	}

	public function addAction()
	{
		try {
			$productId = (int) $this->getRequest()->getParams('pid');
			if (!$productId) {
				throw new Exception("Invalid request.", 1);
			}

			$media = Ccc::getModel('product_media');
			$layout = $this->getLayout();
			$edit = $layout->createBlock('Product_Media_Edit')->setData(['media'=>$media]);
			$layout->getChild('content')->addChild('edit', $edit);
			$layout->render();
		} catch (\Throwable $th) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
		}
	}

	

	public function saveAction()
	{
		try {
			if (!$productId = $this->getRequest()->getParams('pid')) {
				throw new Exception("Invalid request.", 1);
			}

			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid Request.", 1);
			}

			$postData = $this->getRequest()->getPost('media');
			if (!$postData) {
				throw new Exception("Data is not posted.", 1);
			}

			$media = Ccc::getModel('product_media')->setData($postData);
			$media->product_id = $productId;
			$media->created_at = date("Y-m-d H:i:s");
			if (!$media->save()) {
				throw new Exception("New media is not inserted.", 1);
			}

			$stringArray = explode('.', $_FILES['media']['name']['image']);
			$extension = $stringArray[1];
			$fileName = $media->getId() . "." . $extension;
			$destination = "View/media_images_uploaded/" . $fileName;

			move_uploaded_file($_FILES['media']['tmp_name']['image'], $destination);

			$media->image = $fileName;
			$media->gallery = '0';
			if (!$media->save()) {
				throw new Exception("Image is not uploaded.", 1);
			}

			$this->getMessageModel()->addMessage("Media has been saved successfully.");
		} catch (\Throwable $th) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect("grid",null,['id'=>null]);
	}

	public function configAction()
	{
		try {
			$productId = $this->getRequest()->getParams('pid');
			if (!$productId) {
				throw new Exception("Invalid request.", 1);
			}

			if (!$this->getRequest()->isPost()) {
				throw new Exception("Invalid request.", 1);
			}

			$postData = $this->getRequest()->getPost('config');
			if (!$postData) {
				throw new Exception("Data is not posted.", 1);
			}

			$baseId = $postData['base'];
			$smallId = $postData['small'];
			$thumbId = $postData['thumb'];
			$galleryIds = $postData['gallery'];
			foreach ($galleryIds as $key => $val) {
				$gIds[] = $val;
			}

			$product = Ccc::getModel('product')->load($productId);
			$product->base_id = $baseId;
			$product->small_id = $smallId;
			$product->thumb_id = $thumbId;
			$product->removeData('updated_at');
			if(!$product->save()){
				throw new Exception("Error while storing base, thumb, small in product.", 1);
			}

			$media = Ccc::getModel('product_media');
			$sql = "SELECT * FROM `{$media->getResource()->getTableName()}` 
					WHERE `product_id` = '{$productId}'";
			$medias = $media->fetchAll($sql);
			foreach ($medias->getData() as $media) {
				$media->gallery = 0;
				$media->save();
			}

			foreach ($gIds as $gId) {
				$media->load($gId, 'media_id')->addData('gallery', 1)->Save();
			}	

			$this->getMessageModel()->addMessage("Media configuration is updated successfully.");
		} catch (\Throwable $th) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
		}

		$this->redirect("grid");
	}

	public function deleteAction()
	{
		try {
			$mediaId = (int) $this->getRequest()->getParams('id');
			if (!$mediaId) {
				throw new Exception("Invalid request.", 1);
			}

			$media = Ccc::getModel('product_media')->load($mediaId);
			if (!$media) {
				throw new Exception("Invalid id", 1);
			}

			$imageName = $media->image;
			if (!$media->delete()) {
				throw new Exception("Unable to delete the media.", 1);
			}

			unlink('View/media_images_uploaded/' . $imageName);
			$this->getMessageModel()->addMessage("Media deleted successfully.");
		} catch (\Throwable $th) {
			$this->getMessageModel()->addMessage($th->getMessage(), Model_Core_Message::FAILURE);
		}
		$this->redirect("grid");
	}
}


?>