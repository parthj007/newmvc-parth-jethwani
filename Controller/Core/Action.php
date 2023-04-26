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

	public function render()
	{
		$this->getView()->render();
	}
	protected function _setTitle($title)
	{
		$this->getLayout()->getChild("head")->setTitle($title);
		return $this;
	}
}

?>