<?php

namespace application\models;

use application\core\Model;

class Model_404 extends Model
{
    public function get_data()
    {
        $data = $_SESSION['page_error'];
        $_SESSION['page_error'] = '';
        return $data;
    }
}