<?php
namespace EeObjects\Forms\Form;

class Group
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var array
     */
    protected $prototype = [];

    /**
     * @var array
     */
    protected $structure = [];

    public function __construct($name = '')
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param array $vars
     * @return mixed
     */
    public function renderTab(array $vars = [])
    {
        $data = $this->toArray();
        $tabs = ee('View')->make('ee:_shared/form/section')
            ->render(array_merge(['name' => false, 'settings' => $data], $vars));

        return $tabs;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        $return = [];
        foreach($this->structure AS $key => $field_set) {
            $return[] = $field_set->toArray();
        }

        return $return;
    }

    /**
     * @param $name
     */
    public function getFieldSet($name): Set
    {
        $tmp_name = $this->buildTmpName($name);
        if (isset($this->structure[$tmp_name])) {
            return $this->structure[$tmp_name];
        }

        $this->structure[$tmp_name] = new Set($name);
        return $this->structure[$tmp_name];
    }

    /**
     * @param $name
     * @return bool
     */
    public function removeFieldSet($name): bool
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
     * @return string
     */
    protected function buildTmpName($name): string
    {
        return '_set_'.$name;
    }
}