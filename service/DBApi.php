<?php
require_once "DBConfig.php";
require_once "classes/views/ErrorPopup.php";

class DBApi
{
    public function getAll($table): array
    {
        $results = [];
        try {
            $query = "SELECT * FROM $table ORDER BY id ASC";
            $result = DBConfig::connect()->query($query);

            for ($results = array (); $row = $result->fetch_assoc(); $results[] = $row);
        } catch (Exception $error) {
            setErrorLog($error);

            $errorMessage = 'Fehler bei der Datenbankverbindung!';
            $errorPage = new ErrorPopup($errorMessage);
            echo $errorPage->getContent();
        }
        return $results;
    }

    public function getEmployeesWithPK($table): array
    {
        $query = "SELECT $table.id, firstname, lastname, salary, gender, name 
                    FROM $table 
                    LEFT JOIN departments d on d.id = $table.department_id 
                    LEFT JOIN genders g on g.id = $table.gender_id 
                    GROUP BY $table.id";
        $result = DBConfig::connect()->query($query);

        for ($results = array (); $row = $result->fetch_assoc(); $results[] = $row);

        return $results;
    }

    public function getGendersWithPK($table): array
    {
        $query = "SELECT $table.id, gender FROM $table 
                    LEFT JOIN employees e on e.gender_id = $table.id 
                    GROUP BY $table.id";
        $result = DBConfig::connect()->query($query);

        for ($results = array (); $row = $result->fetch_assoc(); $results[] = $row);

        return $results;
    }

    public function create($table, $values): void
    {
        $query = "INSERT INTO $table (";

        foreach ($values as $field => $value) $query .= $field.", ";
        $query = substr($query, 0, -2);
        $query .= ") VALUES (";

        foreach ($values as $value) {
            $query .= is_numeric($value)
            ? addslashes($value) . ","
            : "'" . addslashes($value) . "',";
        };
        $query = substr($query, 0, -1);
        $query .= ")";

        DBConfig::connect()->query($query);
    }

    public function delete($table, $id): void
    {
        $query = "DELETE FROM $table WHERE id = $id";
        DBConfig::connect()->query($query);
    }

    public function update($table, $values, $id): void
    {
        $query = "UPDATE $table SET ";
        foreach ($values as $field => $value) {
            $query .= $field === 'id'
                ?  ""
                : "$field = '" . addslashes($value) . "', ";
        };
        $query = substr($query, 0, -2);
        $query .= " WHERE id = $id";

        DBConfig::connect()->query($query);
    }

    public function getById($table, $id): bool|array|null
    {
        $query = "SELECT * FROM $table WHERE id = $id";

        return DBConfig::connect()->query($query)->fetch_assoc();
    }

    public function getEmployeeById($table, $id): bool|array|null
    {
        $query = "SELECT $table.id, firstname, lastname, salary, gender, gender_id, department_id FROM $table 
                    JOIN genders g on g.id = $table.gender_id                  
                    AND $table.id = $id
                    GROUP BY $table.id";

        return DBConfig::connect()->query($query)->fetch_assoc();
    }
}