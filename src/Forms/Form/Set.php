<?php
namespace EeObjects\Forms\Form;

use EeObjects\Forms\Form\Traits\FieldTrait;

class Set
{
    use FieldTrait;

    protected $name = '';

    /**
     * @var array
     */
    protected $prototype = [
        'title' => '',
        'desc' => false,
        'desc_cont' => false,
        'example' => false,
        'button' => []
    ];

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct($name = '')
    {
        $this->name = $this->prototype['title'] = $name;
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