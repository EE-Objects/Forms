<?php
namespace EeObjects\Forms;

class Form
{
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

    }

    /**
     * @param $name
     * @param $type
     * @return mixed
     */
    public function getField($name, $type)
    {
        $tmp_name = '_field_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $field = $this->buildField($name, $type);
        $this->structure[$tmp_name] = new $field($name);
        return $this;
    }

    /**
     * @param $name
     * @param $type
     * @return string
     */
    protected function buildField($name, $type)
    {
        $field = '\EeObjects\Forms\Form\Fields\\'.$this->studly($type);
        if (class_exists($field)) {
            return $field;
        }
    }

    /**
     * @param string $value
     * @return string
     */
    protected function studly($value)
    {
        return str_replace(' ', '',
            ucwords(str_replace(['-', '_'], ' ', $value))
        );
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
        if(isset($this->data[$name])) {
            $this->data[$name] = $value;
        }

        return $this;
    }
}