<?php
require_once "DBConfig.php";

class DBApi
{
    public function getAll($table): array
    {
        $query = "SELECT * FROM $table ORDER BY id ASC";
        $result = DBConfig::connect()->query($query);

        for ($results = array (); $row = $result->fetch_assoc(); $results[] = $row);

        return $results;
    }

    public function getAllWithPK($table): array
    {
        $query = "SELECT $table.id, firstname, lastname, salary, gender, name FROM $table JOIN departments d on d.id = $table.department_id";
        $result = DBConfig::connect()->query($query);

        for ($results = array (); $row = $result->fetch_assoc(); $results[] = $row);

        return $results;
    }

    public function create($table, $data): void
    {

        $query = "INSERT INTO $table(id, name) values (null, '$data')";
        DBConfig::connect()->query($query);
    }

    public function createEmp($table, $data): void
    {

        $query = "INSERT INTO $table(id, firstname, lastname, salary, gender, department_id) values (null, $data)";
        DBConfig::connect()->query($query);
    }

    public function delete($table, $id): void
    {
        $query = "DELETE FROM $table WHERE id = $id";
        DBConfig::connect()->query($query);
    }

    public function update($table, $name, $id): void
    {
        $query = "UPDATE $table SET name='$name' WHERE id = $id";
        DBConfig::connect()->query($query);
    }

    public function updateEmp($table, $data, $id): void
    {
        $query = "UPDATE $table 
                SET 
                    firstname='$data[0]', 
                    lastname='$data[1]', 
                    salary='$data[2]', 
                    gender='$data[3]', 
                    department_id='$data[4]'
                WHERE id = $id";
        DBConfig::connect()->query($query);
    }

    public function getById($table, $id): bool|array|null
    {
        $query = "SELECT * FROM $table WHERE id = $id";

        return DBConfig::connect()->query($query)->fetch_assoc();
    }
}