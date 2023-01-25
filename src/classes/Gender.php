<?php

require_once "GlobalClass.php";

class Gender extends GlobalClass
{
    public function __construct()
    {
        parent::__construct("genders");
    }

    public function getGenders(): array
    {
        return $this->getAllGenders();
    }
}
