<?php
namespace EeObjects\Forms\Form\Fields;

use EeObjects\Forms\Form\Field;

class Textarea extends Field
{
    /**
     * @var null[]
     */
    protected $field_prototype = [
        'kill_pipes' => null,
        'cols' => null,
        'rows' => null
    ];
}