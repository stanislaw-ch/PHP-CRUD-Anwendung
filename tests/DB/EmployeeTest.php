<?php
use PHPUnit\Framework\TestCase;
require_once "service/DBApi.php";
require_once "classes/Employee.php";

class StackTest extends TestCase
{
    public function getEmployees()
    {
        $api = new DBApi();
        $employee = new Employee($api);

        $employees = $employee->getAllEmployees();
        $this->assertSame(12, count($employees));
    }
}
