<?php
require_once "GlobalClass.php";

class Department extends GlobalClass {
    public function __construct($api){
        parent::__construct("departments", $api);
    }

    public function getDepartments(): array
    {
       return $this->getAllDepartments();
    }
}
