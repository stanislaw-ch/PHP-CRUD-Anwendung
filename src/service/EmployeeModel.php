<?php
require_once "Database.php";
require_once "utils.php";

class EmployeeModel
{
    private string $table;

    public function __construct()
    {
        $this->table = "employees";
    }

    public function getAll(): array
    {
        $results = [];
        try {
            $query = "SELECT $this->table.id, firstname, lastname, salary, gender, name 
                    FROM $this->table 
                    LEFT JOIN departments d ON d.id = $this->table.department_id 
                    LEFT JOIN genders g ON g.id = $this->table.gender_id 
                    GROUP BY $this->table.id";
            $result = Database::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row) ;
        } catch (Exception $error) {
            onError($error);
        }

        return $results;
    }

    public function create($values): void
    {
        try {
            $stmt = Database::connect()->prepare(
                "INSERT INTO $this->table(firstname, lastname, salary, gender_id, department_id) 
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
            $message = $this->table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

    public function update($id, $values): void
    {
        try {
            $stmt = Database::connect()->prepare(
                "UPDATE $this->table 
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
            $message = $this->table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
    }

    public function getById($id): bool|array|null
    {
        try {
            $stmt = Database::connect()->prepare(
                "SELECT $this->table.id, firstname, lastname, salary, gender, gender_id, department_id 
                 FROM $this->table 
                 JOIN genders g ON g.id = $this->table.gender_id                  
                 AND $this->table.id = ?
                 GROUP BY $this->table.id");
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        } catch (Exception $error) {
            onError($error);
        }

        return false;
    }

    public function delete($id): void
    {
        try {
            $stmt = Database::connect()->prepare("DELETE FROM $this->table WHERE id = ?");
            $stmt->bind_param("i", $id);
            $stmt->execute();
        } catch (Exception $error) {
            onError($error);
        }
    }
}