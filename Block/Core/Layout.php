<?php

class Block_Core_Layout extends Block_Core_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->setTemplate('core/layout/3columns.phtml');
        $this->prepareChildren();
    }

    protected function prepareChildren()
    {

        $head = $this->createBlock('Html_Head');
        $this->addChild('head', $head);

        $header = $this->createBlock('Html_Header');
        $this->addChild('header', $header);

        $message = $this->createBlock('Html_Message');
        $this->addChild('message', $message);

        $left = $this->createBlock('Html_Left');
        $this->addChild('left', $left);

        $content = $this->createBlock('Html_Content');
        $this->addChild('content', $content);

        $right = $this->createBlock('Html_Right');
        $this->addChild('right', $right);

        $footer = $this->createBlock('Html_Footer');
        $this->addChild('footer', $footer);
    }

    public function createBlock($block)
    {
        $blockClassName = 'Block_' . $block;
        $block = new $blockClassName();
        $block->setLayout($this);
        return $block;
    }


}