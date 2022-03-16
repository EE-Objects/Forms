<?php
namespace EeObjects\Forms;

use EeObjects\Forms\Form\Group;
use EeObjects\Forms\Form\BUtton;
use EeObjects\Forms\Form\Fields\Hidden;

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
        'alerts_name' => null,
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
     * @var array
     */
    protected $buttons = [];

    /**
     * @var array
     */
    protected $hidden_fields = [];

    /**
     * @var bool
     */
    protected $tab = false;

    /**
     * @return $this
     */
    public function asTab(): Form
    {
        $this->tab = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTab(): bool
    {
        return $this->tab;
    }

    /**
     * @return $this
     */
    public function asHeading(): Form
    {
        $this->tab = false;
        return $this;
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getGroup($name): Group
    {
        $tmp_name = '_group_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = new Group($name);
        return $this->structure[$tmp_name];
    }

    /**
     * @param $name
     * @return Button
     */
    public function getButton($name): Button
    {
        $tmp_name = '_button_'.$name;
        if (isset($this->buttons[$tmp_name])) {
            return $this->buttons[$tmp_name];
        }

        $this->buttons[$tmp_name] = new Button($name);
        return $this->buttons[$tmp_name];
    }

    /**
     * @param $name
     * @return Hidden
     */
    public function getHiddenField($name): Hidden
    {
        $tmp_name = '_hf_'.$name;
        if (isset($this->hidden_fields[$tmp_name])) {
            return $this->hidden_fields[$tmp_name];
        }

        $this->hidden_fields[$tmp_name] = new Hidden($name);
        return $this->hidden_fields[$tmp_name];
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
            if($this->isTab()) {
                $data = $structure->toArray();
                $tab = ee('View')->make('ee:_shared/form/section')
                    ->render(array_merge(['name' => false, 'settings' => $data], $return));
                $tabs[$structure->getName()] = $tab;
            } else {
                $sections[$structure->getName()] = $structure->toArray();
            }
        }

        $return['sections'] = $sections;
        if($tabs) {
            $return['tabs'] = $tabs;
            $return['sections'] = [];
        }

        $buttons = [];
        foreach($this->buttons AS $button) {
            $buttons[] = $button->toArray();
        }

        if($buttons) {
            $return['buttons'] = $buttons;
        }

        $hidden_fields = [];
        foreach($this->hidden_fields AS $hidden_field) {
            $hidden_fields[$hidden_field->getName()] = $hidden_field->get('value');
        }

        if($hidden_fields) {
            $return['form_hidden'] = $hidden_fields;
        }

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