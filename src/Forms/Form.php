<?php
namespace EeObjects\Forms;

use EeObjects\Forms\Form\Traits\FieldTrait;
use EeObjects\Forms\Form\Traits\SetTrait;
use EeObjects\Forms\Form\Group;
use EeObjects\Forms\Form\Set;
use EeObjects\Forms\Form\Field;

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
        'form_hidden' => null,
        'cp_page_title_alt' => null,
        'cp_page_title' => '',
        'action_button' => null,
        'hide_top_buttons' => null,
        'extra_alerts' => null,
        'buttons' => null,
        'base_url' => '',
        'sections' => null,
        'tabs' => null
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
        $data = $this->compile();
        return $data;
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

    /**
     * @return array
     */
    protected function compile()
    {
        $return = [];
        foreach($this->prototype AS $key => $value) {
            if(!is_null($value)) {
                $return[$key] = $value;
            }
        }

        $sections = $tabs = $fields = [];
        $count = $group_name = 0;
        foreach($this->structure AS $structure)
        {
            if($structure instanceof Group) {
                if($structure->isTab()) {
                    $tabs[$structure->getName()] = $structure->renderTab();
                } else {
                    $sections[$structure->getName()] = $structure->toArray();
                }
                $group_name = $structure->getName();
            } elseif($structure instanceof Set) {
                $sections[$group_name][] = $structure->toArray();
            } elseif($structure instanceof Field) {
                $sections[$group_name][] = $structure->asSet();
            }
        }


        print_r($sections);
        exit;

        $return['sections'] = $sections;
        $return['tabs'] = $tabs;

        return $return;
    }

    protected function normalize()
    {
        $count = $group_name = 0;
        $return = [];
        foreach($this->structure AS $structure)
        {
            if($structure instanceof Group) {
                $return[$structure->getName()] = $structure->toArray();
                $group_name = $structure->getName();
            } elseif($structure instanceof Set) {
                $return[$group_name][] = $structure->toArray();
            } elseif($structure instanceof Field) {
                $return[$group_name][] = $structure->asSet();
            }

            $count++;
        }

        print_r($return);
        exit;

        return $return;
    }
}