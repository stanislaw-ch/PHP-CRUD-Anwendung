<?php
require_once "Database.php";
require_once "utils.php";

class DepartmentModel
{
    private string $table;

    public function __construct()
    {
        $this->table = "departments";
    }

    public function getAll(): array
    {
        $results = [];
        try {
            $query = "SELECT $this->table.id, name, COUNT(e.department_id) AS 'count' FROM $this->table 
                            LEFT JOIN employees e ON e.department_id = $this->table.id
                            GROUP BY $this->table.id
            ";
            $result = Database::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row);
        } catch (Exception $error) {
            onError($error);
        }
        return $results;
    }

    public function create($values): void
    {
        try {
            $stmt = Database::connect()->prepare("INSERT INTO $this->table(name) VALUES (?)");
            $stmt->bind_param("s", $values['name']);
            $stmt->execute();
        } catch (Exception $error) {
            $message = $this->table === 'employees'
                ? $values['firstname'] . ' ' . $values['lastname'] . ' ist schon vorhanden'
                : $values['name'] . ' ist schon vorhanden';
            onError($error, $message);
        }
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

    public function update($id, $values): void
    {
        try {
            $stmt = Database::connect()->prepare("UPDATE $this->table SET name = ? WHERE id = ?");
            $stmt->bind_param("si", $values['name'], $id);
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
            $stmt = Database::connect()->prepare("SELECT * FROM $this->table WHERE id = ?");
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