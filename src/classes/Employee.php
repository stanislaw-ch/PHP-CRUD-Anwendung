<?php

require_once "GlobalClass.php";

class Employee extends GlobalClass
{
    public function __construct()
    {
        parent::__construct("employees");
    }

    public function getEmployees(): array
    {
        return $this->getAllEmployees();
    }
}
