<?php

require_once "config.php";
require_once "utils.php";

class Database
{
    private static object $dbh;

    /**
     * @throws Exception
     */
    public static function connect(): object
    {
        if (!isset(self::$dbh)) {
            try {
                self::$dbh = new mysqli(
                    DB_SERVER,
                    DB_USERNAME,
                    DB_PASSWORD,
                    DB_NAME);
            } catch (Exception $error) {
                onError($error);
                die();
            }

        }
        return self::$dbh;
    }
}