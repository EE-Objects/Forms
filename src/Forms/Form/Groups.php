<?php
namespace EeObjects\Forms\Form;

use ExpressionEngine\Library\Data\Collection as CoreCollection;

class Groups extends CoreCollection
{
    protected $tab = false;

    public function asTabView()
    {
        $this->tab = true;
        return $this;
    }


}