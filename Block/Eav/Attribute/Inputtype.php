<?php

class Block_Eav_Attribute_Inputtype extends Block_Core_Template
{   
    protected $_row = null;
    protected $_attribute = null;
    
    function __construct()
    {
        parent::__construct();
        $this->setTemplate('eav/attribute/inputtype.phtml');
    }

    public function getRow()
    {
        return $this->_row;
    }

    public function setRow($row)
    {
        $this->_row = $row;
        return $this;
    }

    public function setAttribute(Model_Eav_Attribute $attribute)
    {
        $this->_attribute = $attribute;
        return $this;
    }

    public function getAttribute()
    {
        return $this->_attribute;
    }

    public function getInputTypeField()
    {
        $row = $this->getRow();
        $attribute = $this->getAttribute();
        if($attribute->input_type == "textbox"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_textbox')->setRow($row)->setAttribute($attribute);
        }elseif($attribute->input_type == "textarea"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_textarea')->setRow($row)->setAttribute($attribute);
        }elseif($attribute->input_type == "select"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_select')->setRow($row)->setAttribute($attribute);
        }elseif($attribute->input_type == "multiselect"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_multiselect')->setRow($row)->setAttribute($attribute);
        }elseif($attribute->input_type == "checkbox"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_checkbox')->setRow($row)->setAttribute($attribute);
        }elseif($attribute->input_type == "radio"){
            return $this->getLayout()->createBlock('eav_attribute_inputtype_radio')->setRow($row)->setAttribute($attribute);
        }else{
            echo "Invalid input type.";
        }
    }


}