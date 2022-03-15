<?php
namespace EeObjects\Forms\Form\Traits;

use EeObjects\Forms\Form\Set;

trait SetTrait
{
    /**
     * @param $name
     * @return Form\Set|mixed
     */
    public function getSet($name)
    {
        $tmp_name = '_set_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = new Set($name);
        return $this->structure[$tmp_name];
    }
}