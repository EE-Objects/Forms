<?php
namespace EeObjects\Forms\Form;

use EeObjects\Forms\Form\Traits\FieldTrait;

class Set
{
    use FieldTrait;

    protected $name = '';

    protected $structure = [];

    public function __construct($name = '')
    {
        $this->name = $name;
    }
}