<?php
class Controller_Core_Action
{
	protected $session = null;
	protected $request = null;
	protected $url = null;
	protected $message = null;
	protected $view = null;
	protected $layout = null;
	protected $title = null;
	protected $_pager = null;
	protected $_response = null;
	protected $_file = null;


	public function setfile(Model_Core_File_Upload $file)
	{
		$this->_file = $file;
		return $this;
	}
	public function getfile()
	{
		if (!$this->_file) {
			$file = new Model_Core_File_Upload();
			$this->setfile($file);
			return $file;
		}
		return $this->_file;
	}

	public function getPager()
	{
		$this->_pager = Ccc::getModel("Model_Core_Pager");
		return $this->_pager;
	}

	public function setLayout(Block_Core_Layout $layout)
	{
		$this->layout = $layout;
		return $this;
	}

	public function getLayout()
	{
		if (!$this->layout) {
			$layout = new Block_Core_Layout();
			$this->setLayout($layout);
			return $layout;
		}
		return $this->layout;
	}

	public function setMessageModel(Model_Core_Message $message)
	{
		$this->message = $message;
		return $this;
	}

	public function setView(Model_Core_View $view)
	{
		$this->view = $view;
		return $this;
	}

	public function getView()
	{
		if ($this->view) {
			return $this->view;
		}
		$view = new Model_Core_View();
		$this->setView($view);
		return $view;
	}

	public function getSessions()
	{
		if ($this->session) {
			return $this->session;
		}
		$session = new Model_Core_Session();
		$this->setSessions($session);
		return $session;
	}

	public function setSessions(Model_Core_Session $session)
	{
		$this->session = $session;
		return $this;
	}

	public function getMessageModel()
	{
		if ($this->message) {
			return $this->message;
		}

		$message = new Model_Core_Message();
		$this->setMessageModel($message);
		return $message;
	}


	public function getUrlModel()
	{
		if ($this->url) {
			return $this->url;
		}
		$url = Ccc::getModel('Core_Url');
		$this->setUrlModel($url);
		return $url;
	}

	public function setUrlModel(Model_Core_Url $url)
	{
		$this->url = $url;
		return $this;
	}


	protected function setRequest(Model_Core_Request $request)
	{
		$this->request = $request;
		return $this;
	}

	public function getRequest()
	{
		if ($this->request != null) {
			return $this->request;
		}
		$request = new Model_Core_Request();
		$this->setRequest($request);
		return $request;
	}


	public function redirect($a = null, $c = null, $params = null, $resetParam = false)
	{
		$url = $this->getUrlModel()->getUrl($a, $c, $params, $resetParam);
		header("location: {$url}");
	}

	public function errorAction($action)
	{
		throw new Exception("Method:{$action} does not exists.", 1);
	}

	protected function setResponse(Model_Core_Response $response)
	{
		$this->_response = $response;
		return $this;
	}

	public function getResponse()
	{
		if ($this->_response != null) {
			return $this->_response;
		}
		$response = new Model_Core_Response();
		$response->setController($this);
		$this->setResponse($response);
		return $response;
	}

	public function renderLayout()
    {
        $this->getResponse()->setBody($this->getLayout()->toHtml());
    }
    
	protected function _setTitle($title)
	{
		$this->getLayout()->getChild("head")->setTitle($title);
		return $this;
	}
}

?>