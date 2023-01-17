<?php

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
        . " "
        . $error->getMessage()
        ."\n", 3, "log/errors.log");
}