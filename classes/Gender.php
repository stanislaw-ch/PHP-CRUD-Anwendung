<?php
require_once "GlobalClass.php";

class Gender extends GlobalClass {
    public function __construct($api){
        parent::__construct("genders", $api);
    }

    public function getGenders(): array
    {
        return $this->getAllGenders();
    }
}
