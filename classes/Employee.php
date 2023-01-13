<?php
require_once "GlobalClass.php";

class Employee extends GlobalClass {
    public function __construct($api){
        parent::__construct("employees", $api);
    }

    public function getEmployees(): array
    {
        return $this->getAllEmployees();
    }
}
