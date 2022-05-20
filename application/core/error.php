<?php

namespace application\core;

class Error
{
    static protected $error = [];

    public function __construct()
    {
        self::$error[0] = '<div class="error">';
        self::$error[1] = '';
        self::$error[2] = '</div>';
    }

    static function throwError($err)
    {
        self::setError($err);
        return self::showError();
    }

    static function showError(): String
    {
        if (!empty($_SESSION['common_error'])) {
            self::$error[1] = 'ERROR: ' . $_SESSION['common_error'];
            $_SESSION['common_error'] = '';
            return implode(' ', self::$error);
        }

        return '';
    }

    static function setError($err)
    {
        $_SESSION['common_error'] = $err;
    }


    static function ErrorPage404($err = 'ERROR')
    {
        $_SESSION['page_error'] = $err;
        $host = 'http://' . $_SERVER['HTTP_HOST'] . '/';
        echo "HOST={$host}<br>";
        header('HTTP/1.1 404 Not Found');
        header('Status: 404 Not Found');
        header('Location:' . $host . '404');
    }
}