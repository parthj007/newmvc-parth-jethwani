<?php

class Model_Eav_Attribute_Resource extends Model_Core_Table_Resource
{
    const STATUS_ACTIVE = 1;
    const STATUS_ACTIVE_LBL = 'Active';
    const STATUS_INACTIVE = 2;
    const STATUS_INACTIVE_LBL = 'Inactive';
    const STATUS_DEFAULT = 2;

    const INPUT_TYPE_RADIO = 'radio';
    const INPUT_TYPE_CHECKBOX = 'checkbox';
    const INPUT_TYPE_SELECT = 'select';
    const INPUT_TYPE_MULTISELECT = 'multiselect';
    const INPUT_TYPE_TEXTBOX = 'textbox';
    const INPUT_TYPE_TEXTAREA = 'textarea';

    const INPUT_TYPE_CHECKBOX_LBL = 'Checkbox';
    const INPUT_TYPE_RADIO_LBL = 'Radio Button';
    const INPUT_TYPE_SELECT_LBL = 'Dropdown';
    const INPUT_TYPE_MULTISELECT_LBL = 'Multiple Select';
    const INPUT_TYPE_TEXTBOX_LBL = 'Text Box';
    const INPUT_TYPE_TEXTAREA_LBL = 'Text Area';

    public function __construct()
    {
        parent::__construct();
        $this->setTableName('eav_attribute');
        $this->setPrimaryKey('attribute_id');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => self::STATUS_ACTIVE_LBL,
            self::STATUS_INACTIVE => self::STATUS_INACTIVE_LBL
        ];
    }

    public function getInputTypeOptions()
    {
        return [
            self::INPUT_TYPE_CHECKBOX => self::INPUT_TYPE_CHECKBOX_LBL,
            self::INPUT_TYPE_RADIO => self::INPUT_TYPE_RADIO_LBL,
            self::INPUT_TYPE_SELECT => self::INPUT_TYPE_SELECT_LBL,
            self::INPUT_TYPE_MULTISELECT => self::INPUT_TYPE_MULTISELECT_LBL,
            self::INPUT_TYPE_TEXTBOX => self::INPUT_TYPE_TEXTBOX_LBL,
            self::INPUT_TYPE_TEXTAREA => self::INPUT_TYPE_TEXTAREA_LBL
        ];
    }



}