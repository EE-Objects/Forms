<?php
namespace EeObjects\Forms;

class Form
{
    /**
     * @var array
     */
    protected $data = [
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

    /**
     * A Collection of Field Groups
     * @var Form\Groups
     */
    protected $groups = null;

    /**
     * A Collection of Field Sets
     * @var Form\Sets
     */
    protected $sets = null;

    /**
     * A Collection of Fields
     * @var Form\Fields
     */
    protected $fields = null;

    /**
     * @var Form\Buttons
     */
    protected $buttons = null;

    protected $hidden_fields = null;

    public function __construct()
    {
        $this->groups = new Form\Groups();
        $this->sets = new Form\Sets();
        $this->fields = new Form\Fields();
        $this->buttons = new Form\Buttons();
        $this->hidden_fields = new Form\Fields();
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getGroup($name)
    {
        if ($this->groups->has($name)) {
            return $this->groups->get($name);
        }

        return $this->groups->create($name);
    }

    public function getSet($name)
    {

    }

    public function getField($name)
    {

    }

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