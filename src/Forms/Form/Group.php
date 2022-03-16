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
     * @var bool
     */
    protected $tab = false;

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }

    /**
     * @return $this
     */
    public function asTab()
    {
        $this->tab = true;
        return $this;
    }

    /**
     * @return bool
     */
    public function isTab()
    {
        return $this->tab;
    }

    /**
     * @return $this
     */
    public function asHeading()
    {
        $this->tab = false;
        return $this;
    }

    public function toArray()
    {
        return [[]];
    }
}