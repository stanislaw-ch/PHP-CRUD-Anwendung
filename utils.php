<?php
require_once "src/classes/views/ErrorPopup.php";

function getSanitized($data): string
{
    $data = trim($data);
    $data = stripslashes($data);
    (int) $data && $data = preg_replace('/,/', '.', $data);
    return htmlspecialchars($data);
}

function isValid($values, $errors): array
{
    foreach ($values as $field=>$value) {
        if (empty($value)) {
            $nameErr = getTextError($field);
            $errors[$field] = $nameErr;
        } else {
            $values[$field] = getSanitized($value);
        }
    }

    if (isset($values['salary'])) {
        if (!is_numeric($values['salary']) && !empty($values['salary'])) {
            $errors['salary'] = 'Nur Zahlen sind erforderlich';
        }
    }

    return array($values, $errors);
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

function onError($error, $errorMessage = 'Fehler bei der Datenbankverbindung!'): void
{
    setErrorLog($error);

    $errorPage = new ErrorPopup($errorMessage);
    echo $errorPage->getContent();
}

function getFieldsToSend($paramFields,$params): array
{
    $fieldsToSend = [];
    foreach ($paramFields as $field) {
        $fieldsToSend[$field] = $params[$field];
    }
    return $fieldsToSend;
}
