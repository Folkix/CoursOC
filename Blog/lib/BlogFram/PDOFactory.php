<?php
/**
 * Created by PhpStorm.
 * User: Folkix
 * Date: 08/05/2017
 * Time: 14:51
 */

namespace BlogFram;


class PDOFactory
{
    public static function getMysqlConnection()
    {
        $db = new \PDO('mysql:host=localhost;dbname=tpoc;charset=utf8;', 'root', '');
        $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $db;
    }

}