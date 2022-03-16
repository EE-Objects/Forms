<?php
namespace EeObjects\Forms;

use EeObjects\Forms\Form\Group;

class Form
{
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
        $this->prototype[$name] = $value;
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

        $sections = $tabs = [];
        foreach($this->structure AS $structure) {
            if($structure->isTab()) {
                $tabs[$structure->getName()] = $structure->renderTab();
            } else {
                $sections[$structure->getName()] = $structure->toArray();
            }
        }

        $return['sections'] = $sections;
        $return['tabs'] = $tabs;

        return $return;
    }

    /**
     * @param $text
     * @param $href
     * @param string $rel
     * @return Group
     */
    public function withActionButton($text, $href, $rel = ''): Form
    {
        $this->set('action_button', ['text' => $text, 'href' => $href, 'rel' => $rel]);
        return $this;
    }
}