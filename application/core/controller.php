<?php

namespace application\core;

use application\core\Page;
use application\core\Error;

class Controller
{
    public $model;
    public $views;

    public $hideButtons = 'wrapper';
    public $headerTitle;
    public $layout = 'main';
    public $pageTitle = 'DEFAULT TITLE';
    public $data = null;
    public $view = 'main_view';
    public $error;
    public $page;

    public function __construct()
    {
	    $this->page = new Page($this->view, $this->pageTitle, $this->hideButtons, $this->headerTitle, $this->layout, $this->data);
        $this->views = new View();
        $this->error = new Error();
    }

    function action_index()
    {
        
    }
}

