<?php

require_once "DBConfig.php";
require_once "utils.php";

class DBApi
{
    public function getDepartments($table): array
    {
        $results = [];
        try {
            $query = "SELECT $table.id, name, COUNT(e.department_id) AS 'count' FROM $table 
                            LEFT JOIN employees e ON e.department_id = $table.id
                            GROUP BY $table.id
            ";
            $result = DBConfig::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row);
        } catch (Exception $error) {
            onError($error);
        }
        return $results;
    }

    public function getEmployeesWithPK($table): array
    {
        $results = [];
        try {
            $query = "SELECT $table.id, firstname, lastname, salary, gender, name 
                    FROM $table 
                    LEFT JOIN departments d ON d.id = $table.department_id 
                    LEFT JOIN genders g ON g.id = $table.gender_id 
                    GROUP BY $table.id";
            $result = DBConfig::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row) ;
        } catch (Exception $error) {
            onError($error);
        }

        return $results;
    }

    public function getGendersWithPK($table): array
    {
        $results = [];
        try {
            $query = "SELECT $table.id, gender FROM $table
                        LEFT JOIN employees e ON e.gender_id = $table.id
                        GROUP BY $table.id";
            $result = DBConfig::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row) ;
        } catch (Exception $error) {
            onError($error);
        }

        return $results;
    }

    public function createDepartment($table, $values): void
    {
        try {
            $stmt = DBConfig::connect()->prepare("INSERT INTO $table(name) VALUES (?)");
            $stmt->bind_param("s", $values['name']);
            $stmt->execute();
        } catch (Exception $error) {
            $message = $table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

    public function createEmployee($table, $values): void
    {
        try {
            $stmt = DBConfig::connect()->prepare(
                "INSERT INTO $table(firstname, lastname, salary, gender_id, department_id) 
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->bind_param(
                "ssiii",
                $values['firstname'],
                $values['lastname'],
                $values['salary'],
                $values['gender_id'],
                $values['department_id']
            );

            $stmt->execute();
        } catch (Exception $error) {
            $message = $table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

//    public function create($table, $values): void
//    {
//        try {
//            $query = "INSERT INTO $table (";
//
//            foreach ($values as $field => $value) $query .= $field . ", ";
//            $query = substr($query, 0, -2);
//            $query .= ") VALUES (";
//
//            foreach ($values as $value) {
//                $query .= is_numeric($value)
//                    ? addslashes($value) . ","
//                    : "'" . addslashes($value) . "',";
//            };
//            $query = substr($query, 0, -1);
//            $query .= ")";
//
//            DBConfig::connect()->query($query);
//        } catch (Exception $error) {
//            $message = $table === 'employees'
//                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
//                : $values['name'] . ' ist schon vorhanden';
//            onError($error, $message);
//        }
//    }

    public function delete($table, $id): void
    {
        try {
            $stmt = DBConfig::connect()->prepare("DELETE FROM $table WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } catch (Exception $error) {
            onError($error);
        }
    }

    public function updateDepartment($table, $id, $values): void
    {
        try {
            $stmt = DBConfig::connect()->prepare("UPDATE $table SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $values['name'], $id);
            $stmt->execute();
        } catch (Exception $error) {
            $message = $table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

    public function updateEmployee($table, $id, $values): void
    {
        try {
            $stmt = DBConfig::connect()->prepare(
                "UPDATE $table 
                 SET firstname = ? , lastname = ?, salary = ?, gender_id = ?, department_id = ? WHERE id = ?"
            );
            $stmt->bind_param(
                "ssiiii",
                $values['firstname'],
                $values['lastname'],
                $values['salary'],
                $values['gender_id'],
                $values['department_id'],
                $id
            );
            $stmt->execute();
        } catch (Exception $error) {
            $message = $table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

//    public function update($table, $id, $values): void
//    {
//        try {
//            $query = "UPDATE $table SET ";
//            foreach ($values as $field => $value) {
//                $query .= $field === 'id'
//                    ? ""
//                    : "$field = '" . addslashes($value) . "', ";
//            };
//            $query = substr($query, 0, -2);
//            $query .= " WHERE id = $id";
//
//            DBConfig::connect()->query($query);
//        } catch (Exception $error) {
//            $message = $table === 'employees'
//                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
//                : $values['name'] . ' ist schon vorhanden';
//            onError($error, $message);
//        }
//    }

    public function getById($table, $id): bool|array|null
    {
        try {
            $stmt = DBConfig::connect()->prepare("SELECT * FROM $table WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $error) {
            onError($error);
        }
        return false;
    }

    public function getEmployeeById($table, $id): bool|array|null
    {
        try {
            $stmt = DBConfig::connect()->prepare(
                "SELECT $table.id, firstname, lastname, salary, gender, gender_id, department_id 
                 FROM $table 
                 JOIN genders g ON g.id = $table.gender_id                  
                 AND $table.id = ?
                 GROUP BY $table.id");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $error) {
            onError($error);
        }

        return false;
    }
}