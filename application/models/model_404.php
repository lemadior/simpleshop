<?php

namespace application\models;

use application\core\Model;

class Model_404 extends Model
{
    public function getData()
    {
        $data = $_SESSION['page_error'];
        $_SESSION['page_error'] = '';
        // if (empty($data)) {
        //     $data = "Sorry, page not found. Check address or try again!";
        // }
        return $data;
    }
}