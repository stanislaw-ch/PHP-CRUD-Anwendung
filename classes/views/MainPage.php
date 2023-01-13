<?php
require_once "classes/views/Modules.php";

class MainPage extends Modules{
    public function __construct($api){
        parent::__construct($api);
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung";
    }

    protected function getTop(){}

    protected function getMiddle(): string
    {
        $html = $this->department->getTablePreView();
        $html .= $this->employee->getTablePreView();
        return $html;
    }
}