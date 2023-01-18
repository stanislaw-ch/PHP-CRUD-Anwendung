<?php
require_once "classes/views/ErrorPopup.php";

function getSanitized($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    return htmlspecialchars($data);
}

function getTextError($typeError): string
{
    return match ($typeError) {
        'name' => 'Abteilungsname ist erforderlich',
        'firstname' => 'Vorname ist erforderlich',
        'lastname' => 'Nachname ist erforderlich',
        'gender_id' => 'Geschlecht ist erforderlich',
        'salary' => 'Gehalt ist erforderlich',
    };
}

function setErrorLog($error): void
{
    error_log(
        "Error: "
        . date("Y-m-d H:i:s")
        ."\n"
        . "     "
        . "message: "
        . $error->getMessage()
        ."\n"
        . "     "
        . "on line: "
        . $error->getLine()
        ."\n"
        . "     "
        . "file: "
        . $error->getFile()
        ."\n"
        . "     "
        . "code: "
        . $error->getCode()
        ."\n"
        . "     "
        . "string: "
        . $error->getTraceAsString()
        ."\n"
        , 3, "log/errors.log");
}

function onError($error): void
{
    setErrorLog($error);

    $errorMessage = 'Fehler bei der Datenbankverbindung!';
    $errorPage = new ErrorPopup($errorMessage);
    echo $errorPage->getContent();
}