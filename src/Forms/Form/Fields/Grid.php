<?php

namespace EeObjects\Forms\Form\Fields;

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