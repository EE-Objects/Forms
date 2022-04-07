<?php

namespace EeObjects\Forms\Form\Fields;

class Input extends Html
{
    /**
     * @return array
     */
    public function toArray(): array
    {
        $defaults = [
            'type' => $this->get('type'),
            'name' => $this->getName(),
            'value' => set_value($this->getName(), $this->getValue())
        ];

        $input = "<input " . _parse_form_attributes($this->getName(), $defaults) . " />";
        $this->setContent($input);
        $this->set('type', 'html');
        return parent::toArray();
    }
}