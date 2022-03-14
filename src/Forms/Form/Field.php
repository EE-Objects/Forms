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
    ];

    protected $field_prototype = [];
}