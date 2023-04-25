<?php
class Block_Shipping_Edit extends Block_Core_Template{

	public function __construct()
	{
		parent::__construct();
	if($shipping_id = Ccc::getModel("Core_Request")->getParams("shipping_id")){
			$shipping = Ccc::getModel('Shipping')->load($shipping_id);
			$this->setTemplate('shipping/edit.phtml')->setData(['shipping' => $shipping]);
		}
		else{
			$shipping = Ccc::getModel('Shipping');
			$this->setTemplate('shipping/edit.phtml')->setData(['shipping' => $shipping]);	
		}
		
	}

}