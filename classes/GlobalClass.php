<?php
require_once "service/DBApi.php";

abstract class GlobalClass
{
    private DBApi $api;
    private string $tableName;

    protected function __construct(string $tableName, DBApi $api){
        $this->api = $api;
        $this->tableName = $tableName;
    }

    public function create(array $newValues): void
    {
        $this->api->create($this->tableName, $newValues);
    }

    public function update($id, $values): void
    {
        $this->api->update($this->tableName, $id, $values);
    }

    public function delete($id): void
    {
        $this->api->delete($this->tableName, $id);
    }

    public function getAllDepartments(): array
    {
        return $this->api->getAll($this->tableName);
    }

    public function getAllEmployees(): array
    {
        return $this->api->getAllWithPK($this->tableName);
    }

    public function getById(string $id): array|bool
    {
        return $this->api->getById($this->tableName, $id);
    }
}