<?php
require_once("Model/Core/Request.php");
require_once("Controller/Core/Action.php");
class Model_Core_Url
{
    public function getCurrentUrl()
    {
        return $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function getUrl($a = null, $c = null, array $param = null, $resetParam = false)
    {
        $request = new Model_Core_Request();

        $final = $request->getParams();

        if ($resetParam) {
            $final = [];
        }

        if ($a) {
            $final['a'] = $a;
        } else {
            $final['a'] = $request->getActionName();
        }

        if ($c) {
            $final['c'] = $c;
        } else {
            $final['c'] = $request->getControllerName();
        }

        if ($param) {
            $final = array_merge($final, $param);
        }

        $queryString = http_build_query($final);

        //  /Project/index.php?
        $requestUri = trim($_SERVER['REQUEST_URI'], $_SERVER['QUERY_STRING']);

        return $_SERVER['REQUEST_SCHEME'] . "://" . $_SERVER["HTTP_HOST"] . $requestUri . $queryString;
    }
}
?>