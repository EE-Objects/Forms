<?php
namespace EeObjects\Forms;

class Form
{
    protected $save_btn_text = 'save';

    protected $save_btn_text_working = 'saving';

    protected $ajax_validate = false;

    protected $has_file_input = false;

    protected $alerts_name = '';

    protected $form_hidden = [];

    protected $cp_page_title_alt = false;

    protected $cp_page_title = '';

    protected $action_button = [];

    protected $hide_top_buttons = [];

    protected $extra_alerts = [];

    protected $buttons = [];

    protected $base_url = '';

    protected $sections = [];

    protected $tabs = [];

    protected $groups = null;

    protected $sets = null;

    protected $fields = null;

    public function getGroup($name)
    {

    }

    public function getSet($name)
    {

    }

    public function getField($name)
    {

    }
}