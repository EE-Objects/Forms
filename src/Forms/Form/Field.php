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

    /**
     * Field constructor.
     * @param string $name
     * @param string $type
     */
    public function __construct(string $name = '', string $type = '')
    {
        $this->name = $name;
        $this->prototype = array_merge($this->default_prototype, $this->field_prototype);
        $this->prototype['name'] = $name;
        $this->prototype['type'] = $type;
    }

    /**
     * @param string $name
     * @param mixed $value
     * @return $this
     */
    public function set(string $name, $value): Field
    {
        $this->prototype[$name] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if(isset($this->prototype[$key])) {
            return $this->prototype[$key];
        }
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