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

    public function create(string $newValues): void
    {
        $this->api->create($this->tableName, $newValues);
    }

    public function update($id, $upd_fields): void
    {
        $this->api->update($this->tableName, $id, $upd_fields);
    }

    public function delete($id): void
    {
        $this->api->delete($this->tableName, $id);
    }

    public function getAll(): array
    {
        return $this->api->getAll($this->tableName);
    }

    public function getById(string $id): array|bool
    {
        return $this->api->getById($this->tableName, $id);
    }
}