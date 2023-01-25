<?php

require_once "src/service/DBApi.php";

abstract class GlobalClass
{
    private DBApi $api;
    private string $tableName;

    protected function __construct(string $tableName)
    {
        $this->api = new DBApi();
        $this->tableName = $tableName;
    }

    public function create(array $newValues): void
    {
        $this->api->create($this->tableName, $newValues);
    }

    public function update($id, $values): void
    {
        print_r($id);
        print_r($values);
        $this->api->update($this->tableName, $id, $values);
    }

    public function delete($id): void
    {
        $this->api->delete($this->tableName, $id);
    }

    public function getAllDepartments(): array
    {
        return $this->api->getDepartments($this->tableName);
    }

    public function getAllEmployees(): array
    {
        return $this->api->getEmployeesWithPK($this->tableName);
    }

    public function getAllGenders(): array
    {
        return $this->api->getGendersWithPK($this->tableName);
    }

    public function getById(string $id): array|bool
    {
        if (strlen($id) === 0) return false;
        return $this->api->getById($this->tableName, $id);
    }

    public function getEmployeeById(string $id): array|bool
    {
        if (strlen($id) === 0) return false;
        return $this->api->getEmployeeById($this->tableName, $id);
    }
}