<?php
class Block_Payment_Edit extends Block_Core_Template{

	public function __construct()
	{
		parent::__construct();
	if($paymentId = Ccc::getModel("Core_Request")->getParams("payment_id")){
			$payment = Ccc::getModel('Payment')->load($paymentId);
			$this->setTemplate('payment/edit.phtml')->setData(['payment' => $payment]);
		}
		else{
			$payment = Ccc::getModel('Payment');
			$this->setTemplate('payment/edit.phtml')->setData(['payment' => $payment]);	
		}
		
	}

}