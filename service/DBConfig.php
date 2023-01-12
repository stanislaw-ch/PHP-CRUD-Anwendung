<?php
require_once "config.php";

class DBConfig
{
    private static object $dbh;

    public static function connect(): object
    {
        if (!isset(self::$dbh)){
            self::$dbh = new mysqli(
                DB_SERVER,
                DB_USERNAME,
                DB_PASSWORD,
                DB_NAME);
        }
        return self::$dbh;
    }
}