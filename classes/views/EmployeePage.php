<?php
require_once "classes/views/Modules.php";

class EmployeePage extends Modules{
    private string $id;
    protected array $errors;
    protected array $values;

    public function __construct($api, $errors=[], $id = '', $values=[]){
        parent::__construct($api);
        $this->id = $id;
        $this->errors = $errors;
        $this->values = $values;

        $this->isActiveMain = '';
        $this->isActiveEmployee = $this->activeClass;
        $this->isActiveDepartment = '';
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Employee page";
    }

    protected function getTop(): string
    {
        return $this->showEmployeeForm();
    }

    protected function getMiddle(): string
    {
        return $this->showEmployeesTable();
    }

    private function showEmployeeForm(): string
    {
        $html =  '
            <div class="w-96 mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <form class="flex flex-col box-border" action="index.php" method="post">';

        $html .= $this->getInput('Vorname', 'firstname');
        $html .= $this->getInput('Nachname', 'lastname');
        $html .= $this->getGenderRadio($this->id, $this->values);
        $html .= $this->getInput('Gehalt', 'salary');
        $html .= $this->getDepartmentsSelect();
        $html .= $this->getButtons($this->id);

        $html .= '       </form>
            </div>
        ';

        return $html;
    }

    public function showEmployeesTable(): string
    {
        $employees = $this->employee->getAllEmployees();

        $html = '
            <div class="w-2/3 mx-auto mb-5 p-7 bg-white shadow-lg shadow-black-500/50">
                <h2 class="mb-5 text-center font-bold">Mitarbeiter</h2>
                <ul>
                    <li class="flex h-7 border-b border-black">
                        <span class="w-8 text-center border-r border-black ">Nr.</span>
                        <span class="w-32 text-center border-r border-black">Vorname</span>
                        <span class="w-32 text-center border-r border-black">Nachname</span>
                        <span class="w-32 text-center border-r border-black">Geschlecht</span>
                        <span class="w-32 text-center border-r border-black">Gehalt</span>
                        <span class="w-32 text-center">Abteilung</span>
                    </li>
        ';

        foreach ($employees as $i=>$employee) {
            $html .= '
                    <li class="flex h-7 border-b border-gray-400 border-dashed">
                        <span class="w-8 min-w-8 text-center border-r border-black">' . ++$i . '</span>
                        <span class="w-32 pl-2 border-r border-black">' . $employee['firstname'] .  '</span>
                        <span class="w-32 pl-2 border-r border-black">' . $employee['lastname'] .  '</span>
                        <span class="w-32 pl-2 border-r border-black">' . $employee['gender'] .  '</span>
                        <span class="w-32 pl-2 border-r border-black">' . $employee['salary'] .  '</span>
                        <span class="w-32 pl-2">' . $employee['name'] .  '</span>
                        <button
                            id="showUpdateEmp"
                            class="
                                w-12 mr-1 ml-auto
                                bg-white hover:underline text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $employee['id'] . '"
                        >Update
                        </button>
                        <button
                            id="deleteEmp"
                            class="
                                w-12 mr-1 
                                bg-white hover:underline text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $employee['id'] . '"
                        >Delete
                        </button>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    private function getInput($label, $type): string
    {
        $html =  '<label for="' . $type . '" class="block text-md font-medium">' . $label . '</label>
                    <input
                            id="$type" type="text"
                            name="' . $type . '"
                            class="border-b-2 border-black px-1 mb-5 h-8 focus:outline-none"
                            placeholder="' . $label . '"';

        $html .= $this->getInputValue($this->id, $this->values, $type);
        $html .= $this->isError($this->errors,$type);

        return $html;
    }

    private function getGenderRadio($id, $values): string
    {
        $type = 'gender_id';
        $html ='<label for="gender" class="block text-md font-medium">Geschlecht</label>';

        if (strlen($id) !== 0 && count($values) === 0){
            $html .= $this->getGendersRadio($this->employee->getEmployeeById($id)['gender_id']);
        } elseif (strlen($id) === 0 && count($values) !== 0) {
            $html .= $this->getGendersRadio($values['gender_id']);
        } elseif (strlen($id) !== 0 && count($values) !== 0) {
            $html .= $this->getGendersRadio($values['gender_id']);
        } else {
            $html .= $values['gender_id'] ?? "<input type='hidden' name='gender_id'>";
            $html .= $this->getGendersRadio();
        }

        $html .= $this->isError($this->errors, $type);
        return $html;
    }

    private function getDepartmentsSelect(): string
    {
        $departments = $this->department->getDepartments();

        $html ='<label for="department" class="block text-md mb-5 font-medium">Abteilung</label>
                    <select 
                            name="department_id" 
                            class="border-b-2 border-black h-8 focus:outline-none"
                    >
        ';

        foreach ($departments as $department) {
            $html .= '<option value="'. $department['id'] . '"';

            if (strlen($this->id) !== 0 && $department['id'] === $this->employee->getEmployeeById($this->id)['department_id']) {
                $html .= 'selected>';
            } else $html .= '>';

            $html .= $department['name'] . '</option>';
        }

        return $html;
    }

    private function getButtons($id): string
    {
        $html = '';

        if (strlen($id) !== 0){
            $html .= '</select>
                    <input type="hidden" name="id" value="' . $this->employee->getEmployeeById($id)['id'] . '">
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="updateEmp">Update
                    </button>';
        } else $html .= '</select>
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="createEmp">Create
                    </button>';
        return $html;
    }

    private function getInputValue($id, $values, $type): string
    {
        $html = '';
        if (strlen($id) !== 0 && count($values) === 0){
            $html .= 'value="'. $this->employee->getEmployeeById($id)[$type] . '">';
        } elseif (strlen($id) === 0 && count($values) !== 0) {
            $html .= 'value="'. $values[$type] . '">';
        } elseif (strlen($id) !== 0 && count($values) !== 0) {
            $html .= 'value="' . $values[$type] . '">';
        } else {
            $html .=   '>';
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

        $genders = $this->gender->getGenders();

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