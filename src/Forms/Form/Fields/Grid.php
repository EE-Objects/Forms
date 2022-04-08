<?php

namespace EeObjects\Forms\Form\Fields;

class Grid extends Table
{
    /**
     * @var null[]
     */
    protected $field_prototype = [
        'content' => '',
        'add' => 'add'
    ];

    /**
     * @param array $row
     * @return $this
     */
    public function defineRow(array $row): Grid
    {
        $this->set('row_definition', $row);
        return $this;
    }

    /**
     * @return string
     */
    protected function renderTable(): string
    {
        $options = is_array($this->getOptions()) ? $this->getOptions() : [];
        $grid = ee('CP/GridInput', $options);
        $grid->setColumns($this->getColumns());

        $no_results = $this->getNoResultsText();
        if(is_array($no_results)) {
            $grid->setNoResultsText($no_results['text'], $no_results['action_text'], $no_results['action_link'], $no_results['external']);
        }

        $grid->setBlankRow($this->generateBlankRow());
        $grid->setData($this->generateDataStructure());
        $grid->loadAssets();
        return ee('View')->make('ee:_shared/table')->render($grid->viewData());;
    }

    /**
     * @return array
     */
    protected function generateBlankRow(): array
    {
        $return = [];
        $default_rows = $this->get('row_definition');
        if(!$default_rows) {
            return $return;
        }

        foreach($default_rows AS $column) {
            $method = 'generate'.ucfirst($column['type']).'Input';
            $choices = isset($column['choices']) ? $column['choices'] : [];
            if(method_exists($this, $method)) {
                $return[] = $this->$method($column['name'], value($column['value']), $choices);
            } else {
                $return[] = $column['type'].' INVALID';
            }
        }

        return $return;
    }

    /**
     * @return array
     */
    protected function generateDataStructure(): array
    {
        $return = [];
        $data = $this->getData();
        if(!$data) {
            return $return;
        }

        $row_prototype = $this->get('row_definition');
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $this->convertPostData();
        }

        foreach($data AS $key => $value) {
            $data = [];
            foreach($row_prototype AS $proto_key => $proto_value) {
                if(isset($value[$proto_value['name']])) {
                    $method = 'generate'.ucfirst($proto_value['type']).'Input';
                    $choices = isset($proto_value['choices']) ? $proto_value['choices'] : [];
                    if(method_exists($this, $method)) {
                        $data[] = $this->$method($proto_value['name'], value($value[$proto_value['name']]), $choices);
                    } else {
                        $data[] = $proto_value['type'].' INVALID';
                    }
                }
            }

            $return[] = [
                'attrs' => [
                    'row_id' => $key,
                ],
                'columns' => $data
            ];
        }

        return $return;
    }

    /**
     * With Grid, we have to handle our own POST processing to handle
     * existing values so we do that here. It looks worse than it it,
     * but due to how some input elements (file, checkbox, for example)
     * won't include a POST value based on "reasons" we use our definition
     * as a base since otherwise we'll miss some parameters.
     * @return array
     */
    protected function convertPostData(): array
    {
        $post_data = $_POST[$this->getName()]['rows'];
        $row_prototype = $this->get('row_definition');
        $return = [];
        foreach($post_data AS $row_id => $row) {
            $data = [];
            foreach($row_prototype As $k => $v) {
                $data[$v['name']] = '';
                if(isset($row[$v['name']])) {
                    $data[$v['name']] = $row[$v['name']];
                }
            }

            $return[] = $data;
        }

        return $return;
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function generateTextInput($name, $value = ''): string
    {
        return form_input($name, $value);
    }

    /**
     * @param $name
     * @param $value
     * @param array $choices
     * @return string
     */
    protected function generateSelectInput($name, $value = '', array $choices = []): string
    {
        return form_dropdown($name, $choices, $value);
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function generatePasswordInput($name, $value = ''): string
    {
        return form_password($name, $value);
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function generateCheckboxInput($name, $value = ''): string
    {
        return form_checkbox($name, $value);
    }

    /**
     * @param $name
     * @param $value
     * @return string
     */
    protected function generateTextareaInput($name, $value = ''): string
    {
        return form_textarea($name, $value);
    }
}