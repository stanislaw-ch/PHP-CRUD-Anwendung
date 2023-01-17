<?php
require_once "config.php";
require_once "classes/views/ErrorPage.php";
require_once "utils.php";

class DBConfig
{
    private static object $dbh;

    /**
     * @throws Exception
     */
    public static function connect(): object
    {
        if (!isset(self::$dbh)){
            try {
                self::$dbh = new mysqli(
                    DB_SERVER,
                    DB_USERNAME,
                    DB_PASSWORD,
                    DB_NAME);
            } catch (Exception $error) {
                setErrorLog($error);

                $errorMessage = 'Fehler bei der Datenbankverbindung!';
                $errorPage = new ErrorPage($errorMessage);
                die($errorPage->getContent());
            }

        }
        return self::$dbh;
    }
}