<?php
namespace EeObjects\Forms;

use EeObjects\Forms\Form\Traits\FieldTrait;

class Form
{
    use FieldTrait;

    /**
     * @var array
     */
    protected $prototype = [
        'save_btn_text' => 'save',
        'save_btn_text_working' => 'saving',
        'ajax_validate' => false,
        'has_file_input' => false,
        'alerts_name' => '',
        'form_hidden' => [],
        'cp_page_title_alt' => false,
        'cp_page_title' => '',
        'action_button' => [],
        'hide_top_buttons' => false,
        'extra_alerts' => [],
        'buttons' => [],
        'base_url' => '',
        'sections' => [],
        'tabs' => []
    ];

    protected $structure = [];

    public function __construct()
    {

    }

    /**
     * @param $name
     * @return mixed
     */
    public function getGroup($name)
    {
        echo 'fdsa';
        exit;
        if ($this->groups->has($name)) {
            return $this->groups->get($name);
        }

        return $this->groups->create($name);
    }

    public function getSet($name)
    {
        $tmp_name = '_set_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = new Form\Set($name);
        return $this->structure[$tmp_name];
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return $this->data;
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