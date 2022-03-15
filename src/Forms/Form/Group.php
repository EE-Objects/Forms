<?php
namespace EeObjects\Forms\Form;

use EeObjects\Forms\Form\Traits\FieldTrait;
use EeObjects\Forms\Form\Traits\SetTrait;

class Group
{
    use FieldTrait,
        SetTrait;

    protected $name = '';

    /**
     * @var array
     */
    protected $prototype = [];

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct($name = '')
    {
        $this->name = $name;
    }
}