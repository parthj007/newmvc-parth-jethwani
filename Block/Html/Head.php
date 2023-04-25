<?php

class Block_Html_Head extends Block_Core_Template
{
     protected $title = null;
     protected $javaScripts  = [];
     protected $styleSheets = [];

    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('html/head.phtml');
    }
    public function getTitle()
    {
        return $this->title;
    }
    public function setTitle($title)
    {
        $this->title = $title;
        return $this->title;
    }
    public function getCss()
    {
        return $this->styleSheets;
    }
    public function setCss($title)
    {
        $this->styleSheets = $styleSheets;
        return $this->styleSheets;
    }
    public function getAllJs()
    {
        return $this->javaScripts;
    }
    public function addJs($src)
    {
        $this->javaScripts[] = $src;
        return $this;
    }
}