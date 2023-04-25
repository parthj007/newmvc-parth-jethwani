<?php
class Model_Core_View
{
    protected $template = null;
    protected $data = [];

    public function __construct()
    {

    }

    public function setTemplate($template)
    {
        $this->template = $template;
        return $this;
    }
    public function getTemplate()
    {
        return $this->template;
    }

    public function __set($key, $value)
    {
        $this->data[$key] = $value;
    }

    public function __get($key)
    {
        if (!array_key_exists($key, $this->data)) {
            return null;
        }
        return $this->data[$key];
    }

    public function __unset($key)
    {
        unset($this->data[$key]);
    }
    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
    public function getData($key = null)
    {
        if ($key) {
            if (array_key_exists($key, $this->data)) {
                return $this->data[$key];
            }
            return null;
        }
        return $this->data;
    }

    public function render()
    {
        require "View/" . DS . $this->getTemplate();
    }

    public function getUrl($a = null, $c = null, $param = null, $resetParams = false)
    {
        return Ccc::getModel('core_url')->getUrl($a, $c, $param, $resetParams);
    }

    public function getMessageModel()
    {
        return Ccc::getModel('core_message');
    }


}

?>