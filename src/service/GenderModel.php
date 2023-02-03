<?php
require_once "Database.php";
require_once "utils.php";

class GenderModel
{
    private string $table;

    public function __construct()
    {
        $this->table = "genders";
    }

    public function getAll(): array
    {
        $results = [];
        try {
            $query = "SELECT $this->table.id, gender FROM $this->table
                        LEFT JOIN employees e ON e.gender_id = $this->table.id
                        GROUP BY $this->table.id";
            $result = Database::connect()->query($query);

            for ($results = array(); $row = $result->fetch_assoc(); $results[] = $row) ;
        } catch (Exception $error) {
            onError($error);
        }

        return $results;
    }
}