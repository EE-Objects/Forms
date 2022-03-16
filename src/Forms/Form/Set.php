<?php
namespace EeObjects\Forms\Form;

class Set
{
    /**
     * @var mixed|string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $prototype = [
        'title' => '',
        'desc' => null,
        'desc_cont' => null,
        'example' => null,
        'button' => null
    ];

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct(string $name = '')
    {
        $this->name = $this->prototype['title'] = $name;
    }

    /**
     * @param $name
     * @param $value
     * @return $this
     */
    public function set($name, $value): Set
    {
        $this->prototype[$name] = $value;
        return $this;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function get($key)
    {
        if(isset($this->prototype[$key])) {
            return $this->prototype[$key];
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $return = [];
        foreach($this->prototype AS $key => $value) {
            if(!is_null($value)) {
                $return[$key] = $value;
            }
        }

        $fields = [];
        foreach($this->structure AS $structure) {
            $fields[$structure->getName()] = $structure->toArray();
        }

        $return['fields'] = $fields;
        return $return;
    }

    /**
     * @param $name
     * @param $type
     */
    public function getField($name, $type): Field
    {
        $tmp_name = $this->buildTmpName($name);
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = $this->buildField($name, $type);
        return $this->structure[$tmp_name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function removeField($name): bool
    {
        $tmp_name = $this->buildTmpName($name);
        if (isset($this->structure[$tmp_name])) {
            unset($this->structure[$tmp_name]);
            return true;
        }

        return false;
    }

    /**
     * @param $name
     * @param $type
     * @return string
     */
    protected function buildField($name, $type): Field
    {
        $field = '\EeObjects\Forms\Form\Fields\\'.$this->studly($type);
        if (class_exists($field)) {
            return new $field($name, $type);
        }

        throw new \Exception($field.' does not exist!');
    }

    /**
     * @param string $value
     * @return string
     */
    protected function studly($value): string
    {
        return str_replace(' ', '',
            ucwords(str_replace(['-', '_'], ' ', $value))
        );
    }

    /**
     * @param $text
     * @param string $rel
     * @param string $for
     * @return $this
     */
    public function withButton($text, $rel = '', $for = ''): Set
    {
        $this->set('button', ['text' => $text, 'rel' => $rel, 'for' => $for]);
        return $this;
    }

    /**
     * @param $name
     * @return string
     */
    protected function buildTmpName($name): string
    {
        return '_field_'.$name;
    }
}