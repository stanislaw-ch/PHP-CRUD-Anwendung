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
//        $sql_condition = '';
//        foreach($newValues as $value) {
//            $sql_condition .= is_numeric($value)
//                ? $value . ", "
//                : "'" . $value . "'" . ", ";
//        }
//
//        $sql_condition = rtrim($sql_condition, ', ');
//
//        echo $sql_condition;
        $this->api->create($this->tableName, $newValues);
    }

    public function createEmp(array $newValues): void
    {
        $sql_condition = '';
        foreach($newValues as $value) {
            $sql_condition .= is_numeric($value)
                ? $value . ", "
                : "'" . $value . "'" . ", ";
        }

        $sql_condition = rtrim($sql_condition, ', ');

        $this->api->createEmp($this->tableName, $sql_condition);
    }

    public function update($id, $upd_fields): void
    {
        $this->api->update($this->tableName, $id, $upd_fields);
    }

    public function updateEmp($id, $upd_fields): void
    {
        $this->api->updateEmp($this->tableName, $id, $upd_fields);
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