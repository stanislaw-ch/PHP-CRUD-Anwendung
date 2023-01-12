<?php
require_once "service/DBApi.php";

class Department_old
{
    private DBApi $db;
    private string $id;
    private string $name;
    private string $tableName = 'departments';

    /**
     * @param DBApi $db
     * @param string $name
     * @param string|null $id
     */
    public function __construct(DBApi $db, string $name, string $id = null)
    {
        $this->db = $db;
        $this->name = $name;

        if (!isset($id)) {
            $this->id = '';
        } else {
            $this->id = $id;
        }
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return Department[]
     */
    private function loadDepartment(): array
    {
        $departments = [];
        $queryResult = $this->db->getAll($this->tableName);

        foreach ($queryResult as $department) {
            $departments[] =
                new Department(
                    $this->db,
                    $department['name'],
                    $department['id']
                );
        }
        return $departments;
    }

    /**
     * @param string $value
     * @return void
     */
    public function saveDepartment(string $value): void
    {
        $this->db->create($this->tableName, $value);
    }

    /**
     * @param string $id
     * @return Department
     */
    public function getDepartmentById(string $id): Department
    {
        $queryResult = $this->db->getById($this->tableName, $id);

        return new Department($this->db, $queryResult['name'], $queryResult['id']);
    }

    /**
     * @return string
     */
    public function getTable(): string
    {
        $departments = $this->loadDepartment();

        $html = '<table>';
        foreach ($departments as $i=>$department){
            $html .= '<tr>';
            $html .= '<td>' . ++$i .  '</td>';
            $html .= '<td>' . $department->getName() .  '</td>';

            $html .= '<td><button type="button" class="showUpdate" data-id="' . $department->getId() . '">Update</button></td>';
            $html .= '<td><button type="button" class="delete" data-id="' . $department->getId() . '">Delete</button></td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }

    public function delete($id): void
    {
        $this->db->delete($this->tableName, $id);
    }

    public function update($name, $id): void
    {
        $this->db->update($this->tableName, $name, $id);
    }
}