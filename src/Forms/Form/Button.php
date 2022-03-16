<?php

namespace EeObjects\Forms\Form;

class Button
{
    /**
     * @var mixed|string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $prototype = [
        'shortcut' => '',
        'attrs' => null,
        'value' => '',
        'name' => 'save',
        'type' => null,
        'class' => null,
        'html' => null,
        'text' => 'save',
        'working' => 'saving'
    ];

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct(string $name = '')
    {
        $this->name = $this->prototype['name'] = $name;
        $this->prototype['type'] = 'button';
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @param $value
     * @return $this
     */
    public function set(string $name, $value): Button
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
        foreach ($this->prototype as $key => $value) {
            if (!is_null($value)) {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}