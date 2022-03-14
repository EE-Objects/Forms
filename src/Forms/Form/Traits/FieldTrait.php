<?php
namespace EeObjects\Forms\Form\Traits;

trait FieldTrait
{

    /**
     * @param $name
     * @param $type
     * @return Form\Field
     */
    public function getField($name, $type)
    {
        $tmp_name = '_field_'.$name;
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = $this->buildField($name, $type);
        return $this->structure[$tmp_name];
    }

    /**
     * @param $name
     * @param $type
     * @return string
     */
    protected function buildField($name, $type)
    {
        $field = '\EeObjects\Forms\Form\Fields\\'.$this->studly($type);
        if (class_exists($field)) {
            return new $field($name);
        }

        throw new \Exception($field.' does not exist!');
    }

    /**
     * @param string $value
     * @return string
     */
    protected function studly($value)
    {
        return str_replace(' ', '',
            ucwords(str_replace(['-', '_'], ' ', $value))
        );
    }
}