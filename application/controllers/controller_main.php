<?php

namespace application\controllers;

use application\core\Controller;
//use application\models\Model_Calen;

class Controller_Main extends Controller
{
    function __construct()
    {
	parent::__construct();
        //$this->model = new Model_Calen();
    }

    function action_index()
    {
        $this->page->data = '';
        $this->page->title = 'Product List';
        $this->page->headerTitle = 'Product List';
        // $this->page->layout = 'main';
        $this->page->view = 'main_view';
        //    echo "<pre>";
        //        print_r($_POST);
        //    echo "</pre>";
 /*       
        if (empty($_POST)) {
            
            $this->page->view = 'calen_view';
        } else {
            foreach ($_POST as $key => $value ) {
                echo "Key=" . $key . " Val=" . $value . "\n";
            }
            //print_r($_POST);
            //echo "AMAMAM";
//            $this->page->data = $this->model->get_data();
 //           $this->page->view = 'calen_info_view';
 //$this->page->view = 'calen_view';
 return;
        }
 */       
        $this->views->render($this->page);
    }
}