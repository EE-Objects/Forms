<?php
namespace EeObjects\Forms;

use EeObjects\Forms\Form\Traits\FieldTrait;
use EeObjects\Forms\Form\Traits\SetTrait;
use EeObjects\Forms\Form\Group;

class Form
{
    use FieldTrait,
        SetTrait;

    /**
     * @var array
     */
    protected $prototype = [
        'save_btn_text' => 'save',
        'save_btn_text_working' => 'saving',
        'ajax_validate' => null,
        'has_file_input' => null,
        'alerts_name' => '',
        'form_hidden' => [],
        'cp_page_title_alt' => null,
        'cp_page_title' => '',
        'action_button' => [],
        'hide_top_buttons' => null,
        'extra_alerts' => [],
        'buttons' => [],
        'base_url' => '',
        'sections' => [],
        'tabs' => []
    ];

    /**
     * Contains the objects, in order, for the form
     * @var array
     */
    protected $structure = [];

    /**
     * @param $name
     * @return mixed
     */
    public function getGroup($name)
    {
        $tmp_name = '_group_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = new Group($name);
        return $this->structure[$tmp_name];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        print_r($this->structure);
        exit;
        return $this->structure;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value)
    {
        if(isset($this->prototype[$name])) {
            $this->prototype[$name] = $value;
        }

        return $this;
    }
}