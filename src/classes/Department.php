<?php

require_once "GlobalClass.php";

class Department extends GlobalClass
{
    public function __construct()
    {
        parent::__construct("departments");
    }

    public function getDepartments(): array
    {
        return $this->getAllDepartments();
    }
}
