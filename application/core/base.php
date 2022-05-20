<?php

namespace application\core;

use application\core\Error;

class Base
{
    private static $connection;

    public static function getLink()
    {
        if (!self::$connection) {
            self::$connection = mysqli_connect(HOST, USER, PASS, DB_NAME);
            if (!self::$connection) {
                Error::setError("Connection failed: " . mysqli_connect_error());
                return null;
            }
            mysqli_query(self::$connection, "SET NAMES 'utf-8'");
        }

        return self::$connection;
    }

    // Return associative array
    public static function getQuery($link, $query) 
    {
        $arr = [];

        $result = mysqli_query($link, $query);
        if (!$result) {
            Error::setError("Connection failed: cannot get query '" . mysqli_error($link) . "'");
            return null;
        }

        while ($row = mysqli_fetch_assoc($result)) {
            $arr[] = $row;
        }

        return $arr;
    }

    // $table - string
    // $where - array
    // $values - array multidimentional
    public static function putValue($link, $table, $where, $data)
    {
        $fields = '';
        $values = '';

        foreach ($where as $field) {
            $fields .= $field . ","; 
        }

        $fields = '(' . rtrim($fields, ',') . ')';

        foreach ($data as $value) {
            $values .= '(';
            
            foreach ($value as $val) {
                if ($val === null) {
                    $values .= 'NULL,';
                } else {
                    $values .= '"' . $val . '",';
                }
            }
            
            $values = rtrim($values, ',') . '),'; 
        }

        $values = rtrim($values, ',');

        echo "Fields=" . $fields . '<br>';
        echo "Values=" . $values . '<br>';

        $sql = "INSERT INTO $table $fields VALUES $values ";
        
        if(!mysqli_query($link, $sql)){
            Error::setError("Ошибка: " . mysqli_error($link));
        }
    }
}