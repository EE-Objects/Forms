<?php

namespace EeObjects\Forms\Form;

abstract class OptionsField extends Field
{
    /**
     * @var null[]
     */
    protected $field_prototype = [
        'choices' => [],
        'no_results' => null,
        'encode' => null,
        'disabled_choices' => null,
        'empty_text' => null,
        'selectable' => null,
        'reorderable' => null,
        'removable' => null,
    ];

    /**
     * @param string $text
     * @param string $link_text
     * @param string $link_href
     * @return $this
     */
    public function withNoResults(string $text, string $link_text, string $link_href): OptionsField
    {
        $this->set('no_results', ['text' => $text, 'link_href' => $link_href, 'link_text' => $link_text]);
        return $this;
    }
}