<?php

namespace application\models;

use application\core\Model;

class Model_Main extends Model
{
    public function get_data()
    {
        $data = $_SESSION['page_error'];
        $_SESSION['page_error'] = '';
        return $data;
    }
}