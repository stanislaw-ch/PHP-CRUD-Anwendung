<?php
require_once "src/views/Page.php";

class EmployeePage extends Page
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
        $this->isActiveEmployee = $this->activeClass;
        $this->isActiveDepartment = '';
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
        $paramFields = ['firstname', 'lastname', 'gender_id', 'salary', 'department_id'];

        switch ($action) {
            case 'create':
                [$this->values, $this->errors] = isValid($this->params, $this->errors);;
                if (empty($this->errors)) {// TODO: check if exists
                    $this->employee->create(getFieldsToSend($paramFields, $this->params));
                    header("Location: /employees");
                }
                break;
            case 'update':
                [$this->values, $this->errors] = isValid($this->params, $this->errors);;
                if (empty($this->errors)) {// TODO: check if exists
                    $this->employee->update($this->id, getFieldsToSend($paramFields, $this->params));
                    header("Location: /employees");
                }
                break;
            case 'delete':
                $this->employee->delete($this->id);
                header("Location: /employees");
                break;
        }
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Employee page";
    }

    protected function getMiddle(): string
    {
        $sr['createForm'] = $this->showEmployeeForm();
        $sr['table'] = $this->showEmployeesTable();

        return $this->getReplaceTemplate($sr, "employeesPage");
    }

    private function showEmployeeForm(): string
    {
        $this->actionHandler($this->action);

        $html = $this->getInput('Vorname', 'firstname');
        $html .= $this->getInput('Nachname', 'lastname');
        $html .= $this->getGenderRadio($this->id, $this->params);
        $html .= $this->getInput('Gehalt', 'salary');
        $html .= $this->getDepartmentsSelect();
        $html .= $this->getButtons($this->id);

        return $html;
    }

    public function showEmployeesTable(): string
    {
        $employees = $this->employee->getAll();
        $html = '';

        foreach ($employees as $i => $employee) {
            $html .= '
                    <li class="
                            hover:cursor-pointer hover:border-solid hover:border-black 
                            row-employee flex h-10 border-b border-gray-400 border-dashed
                        "
                    >
                        <span id="index" class="
                            flex self-center justify-center  
                            w-8
                        ">' . ++$i . '</span>
                        <span id="firstname" class="
                            flex self-center 
                            pl-2 grow
                            basis-40 
                            hidden sm:flex
                        ">' . $employee['firstname'] . '</span>
                        <span id="lastname" class="
                            flex self-center 
                            pl-2 grow
                            basis-40
                        ">' . $employee['lastname'] . '</span>
                        <span id="gender" class="
                            flex self-center 
                            pl-2 grow
                            basis-40 
                            hidden lg:flex
                        ">' . $employee['gender'] . '</span>
                        <span id="salary" class="
                            flex self-center 
                            pl-2  grow
                            basis-40  
                            hidden sm:flex
                            
                        ">' . $employee['salary'] . '</span>
                        <div class="
                            flex self-center 
                            sm:justify-start
                            grow
                            basis-40 
                            pl-2
                        ">
                            <span id="department" class="">' . $employee['name'] . '</span>
                            <input type="hidden" name="id" value="' . $employee['id'] . '"/>
                        </div>
                    </li>';
        }

        return $html;
    }

    private function getInput($label, $type): string
    {
        $html = '<label for="' . $type . '" class="block text-md font-medium">' . $label . '</label>
                    <input
                            id="$type" type="text"
                            name="' . $type . '"
                            class="border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                            placeholder="' . $label . '"';

        $html .= $this->getInputValue($this->id, $this->params, $type);
        $html .= $this->isError($this->errors, $type);

        return $html;
    }

    private function getGenderRadio($id, $values): string
    {
        $type = 'gender_id';
        $html = '<label for="gender" class="block text-md font-medium">Geschlecht</label>';
        $genders = '';

        if ($this->employee->getById($id)) {
            $genders = $this->employee->getById($id)[$type];
        }

        if (strlen($id) !== 0 && count($values) === 1) {
            $html .= $this->getGendersRadio($genders);
        } elseif (strlen($id) === 0 && count($values) > 1) {
            $html .= $this->getGendersRadio($values[$type]);
        } elseif (strlen($id) !== 0 && count($values) > 1) {
            $html .= $this->getGendersRadio($values[$type]);
        } else {
            $html .= $values[$type] ?? "<input type='hidden' name='gender_id'>";
            $html .= $this->getGendersRadio();
        }

        $html .= $this->isError($this->errors, $type);
        return $html;
    }

    private function getDepartmentsSelect(): string
    {
        $departments = $this->department->getAll();

        $html = '<label for="department" class="block text-md font-medium">Abteilung</label>
                    <select 
                            name="department_id" 
                            class="border-b-2 border-black mb-5 h-8 focus:outline-none"
                    >
        ';

        foreach ($departments as $department) {
            $html .= '<option value="' . $department['id'] . '"';
            $departmentId = '';

            if ($this->employee->getById($this->id)) {
                $departmentId = $this->employee->getById($this->id)['department_id'];
            }

            if (strlen($this->id) !== 0 && $department['id'] === $departmentId) {
                $html .= 'selected>';
            } else $html .= '>';

            $html .= $department['name'] . '</option>';
        }
        $html .= '</select>';

        return $html;
    }

    private function getButtons($id): string
    {
        $html = '';
        $employeeId = '';

        if ($this->employee->getById($id)) {
            $employeeId = $this->employee->getById($id)['id'];
        }

        if (strlen($id) !== 0) {
            $html .= '
                    <input type="hidden" name="id" value="' . $employeeId . '">
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="update">Update
                    </button>';
        } else $html .= '
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="create">Create
                    </button>';
        return $html;
    }

    private function getInputValue($id, $values, $type): string
    {
        $html = '';
        $value = '';

        if ($this->employee->getById($id)) {
            $value = $this->employee->getById($id)[$type];
        }

        if (strlen($id) !== 0 && count($values) === 1) {
            $html .= 'value="' . $value . '">';
        } elseif (strlen($id) === 0 && count($values) > 1) {
            $html .= 'value="' . $values[$type] . '">';
        } elseif (strlen($id) !== 0 && count($values) > 1) {
            $html .= 'value="' . $values[$type] . '">';
        } else {
            $html .= '>';
        }

        return $html;
    }

    private function getGendersRadio($value = null): string
    {
        $GenderType = array(
            'Female' => 1,
            'Male' => 2,
            'Diverse' => 3,
        );

        if (!isset($value)) {
            $value = $GenderType['Female'];
        }

        $genders = $this->gender->getAll();

        $html = "<div class='flex mt-2 mb-5 justify-between'>";
        foreach ($genders as $gender) {
            $html .= "<div class='flex items-center'>";
            $html .= "<input id='" . $gender['gender'] . "' type='radio' name='gender_id' value='" . $gender['id'] . "'";
            $html .= " class='mr-2'";
            if ($value == $gender['id']) {
                $html .= "checked";
            }

            $html .= ">";
            $html .= "<label for='" . $gender['gender'] . "'>" . $gender['gender'] . "</label>";
            $html .= "</div>";
        }

        $html .= "</div>";
        return $html;
    }
}