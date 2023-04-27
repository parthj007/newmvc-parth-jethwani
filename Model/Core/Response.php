<?php
class Model_Core_Response
{
	protected $_jsonData = [
		
	];

	protected $_controller = null;

	public function setController($controller)
	{
		$this->_controller = $controller;
		return $this;	
	}

	private function getController()
	{
		return $this->_controller;
	}

	public function setJsonData($data)
	{
		$this->_jsonData = array_merge($this->_jsonData, $data);
		return $this;
	}

	public function getJsonData()
	{
		return $this->_jsonData; 
	}

	public function setBody($content)
	{
		echo $content;
		@header('content-type: text/html');
		die;
	}	
	
	public function jsonResponse($data)
	{
		$this->setJsonData($data);
		$this->setMessageResponse();
		echo json_encode($this->getJsonData());
		@header('content-type:application/json');
		die;
	}

	public function setMessageResponse()
	{
		$messageHtml = $this->getController()->getLayout()->createBlock('Html_Message')->toHtml();
		Ccc::log($messageHtml,"message.log");
		$this->setJsonData(['messageBlockHtml' => $messageHtml]);
	}
}

