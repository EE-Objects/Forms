<?php
namespace EeObjects\Forms\Form\Fields;

use EeObjects\Forms\Form\Field;

class Textarea extends Field
{
    /**
     * @var int[]
     */
    protected $field_prototype = [
        'maxlength' => null,
        'type' => 'textarea',
        'cols' => null,
        'rows' => null
    ];
}