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

    /**
     * Set constructor.
     * @param string $name
     */
    public function __construct(string $name = '')
    {
        $this->name = $this->prototype['title'] = $name;
    }

    /**
     * @param string $name
     * @param $value
     * @return $this
     */
    public function set(string $name, $value): Set
    {
        $this->prototype[$name] = $value;
        return $this;
    }

    /**
     * @param string $key
     * @return mixed
     */
    public function get(string $key)
    {
        if (isset($this->prototype[$key])) {
            return $this->prototype[$key];
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $return = [];
        foreach ($this->prototype as $key => $value) {
            if (!is_null($value)) {
                $return[$key] = $value;
            }
        }

        $fields = [];
        foreach ($this->structure as $structure) {
            $fields[$structure->getName()] = $structure->toArray();
        }

        $return['fields'] = $fields;
        return $return;
    }

    /**
     * @param string $name
     * @param string $type
     * @return Field
     * @throws \Exception
     */
    public function getField(string $name, string $type): Field
    {
        $tmp_name = $this->buildTmpName($name);
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = $this->buildField($name, $type);
        return $this->structure[$tmp_name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function removeField(string $name): bool
    {
        $tmp_name = $this->buildTmpName($name);
        if (isset($this->structure[$tmp_name])) {
            unset($this->structure[$tmp_name]);
            return true;
        }

        return false;
    }

    /**
     * @param string $name
     * @param string $type
     * @return Field
     * @throws \Exception
     */
    protected function buildField(string $name, string $type): Field
    {
        $field = '\EeObjects\Forms\Form\Fields\\' . $this->studly($type);
        if (class_exists($field)) {
            return new $field($name, $type);
        }

        throw new \Exception($field . ' does not exist!');
    }

    /**
     * @param string $value
     * @return string
     */
    protected function studly(string $value): string
    {
        return str_replace(' ', '',
            ucwords(str_replace(['-', '_'], ' ', $value))
        );
    }

    /**
     * @param string $text
     * @param string $rel
     * @param string $for
     * @return $this
     */
    public function withButton(string $text, string $rel = '', string $for = ''): Set
    {
        $this->set('button', ['text' => $text, 'rel' => $rel, 'for' => $for]);
        return $this;
    }

    /**
     * @param string $name
     * @return string
     */
    protected function buildTmpName(string $name): string
    {
        return '_field_' . $name;
    }
}