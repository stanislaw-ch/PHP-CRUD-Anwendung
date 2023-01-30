<?php

require_once "src/classes/views/Modules.php";

class DepartmentPage extends Modules
{
    private string $id;
    private array $errors;
    private array $values;
    private array $params;
    private string $action;

    public function __construct()
    {
        parent::__construct();
        $this->id = '';
        $this->errors = [];
        $this->values = [];
        $this->params = [];
        $this->action = '';

        $this->isActiveMain = '';
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = $this->activeClass;
    }

    public function execute(array $params = []): void
    {
        $this->action = $params['action'] ?? '';
        $this->id = $params['id'] ?? '';
        $this->params = $params;

        $this->getContent();
    }

    private function actionHandler($action)
    {
        $paramFields = ['name'];

        switch ($action) {
            case 'create':
                [$this->values, $this->errors] = isValid($this->params, $this->errors);;
                if (empty($this->errors)) {
                    // TODO: check if exists
                    $this->department->createDepartment(getFieldsToSend($paramFields, $this->params));
                    header("Location: /departments");
                }
                break;
            case 'update':
                [$this->values, $this->errors] = isValid($this->params, $this->errors);;
                if (empty($this->errors)) {
                    // TODO: check if exists
                    print_r($_GET);
                    print_r($_POST);

                    $this->department->updateDepartment($this->id, getFieldsToSend($paramFields, $this->params));
                    header("Location: /departments");
                }
                break;
            case 'delete':
                // TODO: check if exists
                $this->department->delete($this->id);
                header("Location: /departments");
                break;
        }
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Department page";
    }

    protected function getMiddle(): string
    {
        $sr['createForm'] = $this->showDepartmentForm();
        $sr['table'] = $this->showDepartmentsTable();

        return $this->getReplaceTemplate($sr, "departmentsPage");
    }

    public function showDepartmentForm(): string
    {
        $this->actionHandler($this->action);
        $html = $this->getInput($this->id, $this->values);
        $html .= $this->getButtons($this->id);

        return $html;
    }

    public function showDepartmentsTable(): string
    {
        $data = $this->department->getDepartments();
        $html = '';

        foreach ($data as $i => $item) {
            $html .= '
                    <li class="
                            row-department   
                            flex h-10 border-b border-gray-400 border-dashed
                            hover:cursor-pointer
                            hover:border-solid hover:border-black
                            "
                    >
                        <span id="index" class="flex self-center justify-center w-8">' . ++$i . '</span>
                        <span id="name" class="flex self-center grow pl-2">' . $item['name'] . '</span>
                        <span id="amount-employees" class="flex self-center justify-center basis-20">' . $item['count'] . '</span>
                        <input type="hidden" name="id" value="' . $item['id'] . '"/>
                    </li>';
        }

        return $html;
    }

    private function getInput($id, $values): string
    {
        $html = '  <label for="name" class="block text-md my-1 font-medium">Abteilungsname</label>
                    <input
                            id="name" type="text"
                            name="name"
                            class="[appearance:textfield] border-b-2 border-black px-2 mb-5 h-8 focus:outline-none appearance-none"
                            placeholder="Abteilungsname"';

        if (strlen($id) !== 0 && count($values) === 0) {
            $name = '';
            $idDep = '';

            if ($this->department->getById($id)) {
                $name = $this->department->getById($id)['name'];
                $idDep = $this->department->getById($id)['id'];
            }
            $html .= 'value="' . $name . '">';
            $html .= '<input type="hidden" name="id" value="' . $idDep . '">';
        } elseif (strlen($id) === 0 && count($values) > 1) {
            $html .= 'value="' . $values['name'] . '">';
        } elseif (strlen($id) !== 0 && count($values) > 1) {
            $html .= 'value="' . $this->department->getById($id)['name'] . '">';
            $html .= '<input type="hidden" name="id" value="' . $this->department->getById($id)['id'] . '">';
        } else {
            $html .= '>';
        }

        $html .= $this->isError($this->errors, 'name');

        return $html;
    }

    private function getButtons($id): string
    {
        $html = '';

        if (strlen($id) !== 0) {
            $html .= '<button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="update">Update
                        </button>';
        } else {
            $html .= '<button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="create">Create
                        </button>';
        }
        return $html;
    }

}