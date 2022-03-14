<?php
namespace EeObjects\Forms\Form;

abstract class Field
{
    /**
     * @var bool
     */
    protected $name = false;

    /**
     * @var array
     */
    protected $default_prototype = [
        'class' => '',
        'margin_top' => false,
        'margin_left' => false,
        'note' => false,
        'attrs' => '',
        'disabled' => false,
        'value' => '',
        'group' => false,
        'group_toggle' => false,
        'required' => false,
        'placeholder' => ''
    ];

    /**
     * @var array
     */
    protected $field_prototype = [];

    /**
     * @var array
     */
    protected $prototype = [];

    public function __construct($name = false)
    {
        $this->name = $name;
        $this->prototype = array_merge($this->default_prototype, $this->field_prototype);
        $this->prototype['name'] = $name;
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