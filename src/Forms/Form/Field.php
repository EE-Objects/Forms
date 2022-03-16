<?php
namespace EeObjects\Forms\Form;

abstract class Field
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $default_prototype = [
        'class' => '',
        'margin_top' => null,
        'margin_left' => null,
        'note' => null,
        'attrs' => '',
        'disabled' => null,
        'value' => '',
        'group' => null,
        'group_toggle' => null,
        'required' => null,
        'maxlength' => null,
        'placeholder' => null
    ];

    /**
     * @var array
     */
    protected $field_prototype = [];

    /**
     * @var array
     */
    protected $prototype = [];

    public function __construct($name = false, $type = false)
    {
        $this->name = $name;
        $this->prototype = array_merge($this->default_prototype, $this->field_prototype);
        $this->prototype['name'] = $name;
        $this->prototype['type'] = $type;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value): Field
    {
        $this->prototype[$name] = $value;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $return = [];
        foreach($this->prototype AS $key => $value) {
            if(!is_null($value)) {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }
}