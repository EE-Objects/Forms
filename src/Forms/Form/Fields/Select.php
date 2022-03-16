<?php

namespace EeObjects\Forms\Form\Fields;

use EeObjects\Forms\Form\OptionsField;

class Select extends OptionsField
{
    /**
     * @var null[]
     */
    protected $field_prototype = [
        'min' => null,
        'max' => null,
        'step' => null,
        'unit' => null,
    ];
}