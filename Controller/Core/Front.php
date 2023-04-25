<?php

class Controller_Core_Front
{
    protected $request = null;

    public function setRequest(Model_Core_Request $request)
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

    public function init()
    {
        Ccc::getModel('core_session')->start();
        $request = $this->getRequest();
        $c = $request->getControllerName();
        $a = $request->getActionName() . "Action";

        // $requestUri = $_SERVER['REQUEST_URI'];
        // $lastChar = substr($requestUri, -1);
        // if ($lastChar != "?") {
        //     $_SERVER['REQUEST_URI'] = $requestUri . "?";
        // }

        $className = "Controller_" . ucwords($c, "_");
        $classPath = str_replace("_", "/", $className);

        require_once("{$classPath}.php");
        $controller = new $className();
        $controller->getRequest();

        if (!method_exists($controller, $a)) {
            $controller->errorAction($a);
        } else {
            $controller->$a();
        }


    }
}

?>