<?php

namespace EeObjects\Forms\Form\Fields;

use EeObjects\Forms\Form\Field;

class Grid extends Html
{
    /**
     * @param $grid
     * @return $this
     */
    public function setGrid($grid): Grid
    {
        $output = ee()->load->view('_shared/table', $grid->viewData(), true);
        parent::setContent($output);
        return $this;
    }
}