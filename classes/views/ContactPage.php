<?php
require_once "classes/views/Modules.php";

class ContactPage extends Modules
{
    private string $id;
    private array $errors;
    private array $values;
    private string $action;
    private string $name;

    public function __construct(){
        parent::__construct();
        $this->id = '';
//        $this->errors = $errors;
//        $this->values = [];
        $this->action = '';
        $this->name = '';

        $this->isActiveMain = '';
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = $this->activeClass;
    }

    public function execute(array $params = []): void
    {
        $this->action = $params['action'] ?? '';
        $this->name = $params['name'] ?? '';
        $this->id = $params['id'] ?? '';

        var_dump($this->action);
        var_dump($this->name);
        var_dump($this->id);

        require_once 'templates/contact.phtml';
    }

    protected function getTitle()
    {
        // TODO: Implement getTitle() method.
    }

    protected function getTop()
    {
        // TODO: Implement getTop() method.
    }

    protected function getMiddle()
    {
        // TODO: Implement getMiddle() method.
    }
}