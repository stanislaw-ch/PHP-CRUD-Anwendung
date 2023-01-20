<?php
require_once "classes/views/ErrorPopup.php";

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

function getValuesWithoutID($post): array
{
    if (count($post) > 1) array_pop($post);
    return $post;
}

function getContent(
    $api,
    $action,
    $object,
    $objectPage,
    $viewType,
    $values,
    $errors,
    $id
)
{
    switch ($action) {
        case 'create' . ucfirst(rtrim($viewType, 's')):
            [$values, $errors] = isValid($values, $errors);

            if (empty($errors)) {// TODO: check if exists
                $object->create($values);
                return new $objectPage($api);
            } else {
                return new $objectPage($api, $errors, $id, $values);
            }
        case 'delete' . ucfirst(rtrim($viewType, 's')):
            $object->delete($id);// TODO: check if exists
            return new $objectPage($api);
        case 'update' . ucfirst(rtrim($viewType, 's')):
            [$values, $errors] = isValid($values, $errors);

            if (empty($errors)) {// TODO: check if exists
                $object->update($values, $id);
                return new $objectPage($api);
            } else {
                return new $objectPage($api, $errors, $id, $values);
            }
        case 'showUpdate' . ucfirst(rtrim($viewType, 's')):
            return new $objectPage($api, $errors, $id);
        case $viewType:
            return new $objectPage($api);
    }
}
