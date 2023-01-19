<?php
require_once "classes/views/Modules.php";

class EmployeePage extends Modules{
    private string $id;
    protected array $errors;
    protected array $values;

    public function __construct($api, $errors=[], $id = false, $values=[]){
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
            <div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <form class="flex flex-col box-border" action="index.php?view=employees" method="post">';

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
            <div class="
                    w-full xl:w-4/6  
                    mx-auto 
                    mb-5 
                    p-7 sm:p-5
                    bg-white 
                    shadow-lg shadow-black-500/50
                ">
                <h2 class="mb-5 text-center text-lg">Mitarbeiter</h2>
                <ul>
                    <li class="flex content-center h-10 text-white bg-slate-700">
                        <span class="
                            flex self-center justify-center
                            w-8
                            ">#</span>
                        <span class="
                            flex self-center 
                            basis-40 pl-2 
                            hidden md:flex
                        ">Vorname</span>
                        <span class="
                            flex self-center  
                            basis-40 pl-2
                        ">Nachname</span>
                        <span class="
                            flex self-center  
                            basis-40 pl-2
                            hidden lg:flex
                        ">Geschlecht</span>
                        <span class=" 
                            flex self-center  
                            basis-40 pl-2
                            hidden sm:flex
                        ">Gehalt</span>
                        <span class="
                            flex self-center  
                            grow pl-2
                            text-transparent sm:text-white
                            basis-40 md:basis-80 
                        ">Abteilung</span>
                    </li>
        ';

        foreach ($employees as $i=>$employee) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="
                            flex self-center justify-center  
                            w-8
                        ">' . ++$i . '</span>
                        <span class="
                            flex self-center 
                            pl-2 
                            basis-40 
                            hidden md:flex
                        ">' . $employee['firstname'] .  '</span>
                        <span class="
                            flex self-center 
                            pl-2 
                            basis-40
                        ">' . $employee['lastname'] .  '</span>
                        <span class="
                            flex self-center 
                            pl-2 
                            basis-40 
                            hidden lg:flex
                        ">' . $employee['gender'] .  '</span>
                        <span class=" 
                            flex self-center 
                            pl-2  
                            basis-40  
                            hidden sm:flex
                        ">' . $employee['salary'] .  '</span>
                        <div class="
                            flex self-center 
                            sm:justify-start
                            grow
                            basis-40 md:basis-80
                            pl-2
                        ">
                            <span class="mr-auto hidden sm:flex">' . $employee['name'] .  '</span>
                            <button
                                id="showUpdateEmployee"
                                class="
                                    w-12 mr-1 sm:ml-auto mr-auto
                                    bg-white hover:underline text-sm
                                "
                                type="button"
                                name="action"
                                data-id="' . $employee['id'] . '"
                                data-view="employees"
                            >Update
                            </button>
                            <button
                                id="deleteEmployee"
                                class="
                                    w-12 mr-1 
                                    bg-white hover:underline text-sm
                                "
                                type="button"
                                name="action"
                                data-id="' . $employee['id'] . '"
                                data-view="employees"
                            >Delete
                            </button>
                        </div>
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
        $genders = '';

        if ($this->employee->getEmployeeById($id)) {
            $genders = $this->employee->getEmployeeById($id)[$type];
        }

        if (strlen($id) !== 0 && count($values) === 0){
            $html .= $this->getGendersRadio($genders);
        } elseif (strlen($id) === 0 && count($values) !== 0) {
            $html .= $this->getGendersRadio($values[$type]);
        } elseif (strlen($id) !== 0 && count($values) !== 0) {
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
        $departments = $this->department->getDepartments();

        $html ='<label for="department" class="block text-md mb-5 font-medium">Abteilung</label>
                    <select 
                            name="department_id" 
                            class="border-b-2 border-black mb-5 h-8 focus:outline-none"
                    >
        ';

        foreach ($departments as $department) {
            $html .= '<option value="'. $department['id'] . '"';
            $departmentId = '';

            if ($this->employee->getEmployeeById($this->id)) {
                $departmentId = $this->employee->getEmployeeById($this->id)['department_id'];
            }

            if (strlen($this->id) !== 0 && $department['id'] === $departmentId) {
                $html .= 'selected>';
            } else $html .= '>';

            $html .= $department['name'] . '</option>';
        }

        return $html;
    }

    private function getButtons($id): string
    {
        $html = '';
        $employeeId = '';

        if ($this->employee->getEmployeeById($id)) {
            $employeeId = $this->employee->getEmployeeById($id)['id'];
        }

        if (strlen($id) !== 0){
            $html .= '</select>
                    <input type="hidden" name="id" value="' . $employeeId . '">
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="updateEmployee">Update
                    </button>';
        } else $html .= '</select>
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="createEmployee">Create
                    </button>';
        return $html;
    }

    private function getInputValue($id, $values, $type): string
    {
        $html = '';
        $value = '';

        if ($this->employee->getEmployeeById($id)) {
            $value = $this->employee->getEmployeeById($id)[$type];
        }

        if (strlen($id) !== 0 && count($values) === 0){
            $html .= 'value="'. $value . '">';
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