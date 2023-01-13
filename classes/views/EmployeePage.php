<?php
require_once "classes/views/Modules.php";

class EmployeePage extends Modules{
    private string $id;

    public function __construct($api, $id = ''){
        parent::__construct($api);
        $this->id = $id;

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
        return $this->showCreate();
    }

    protected function getMiddle(): string
    {
        return $this->showEmployees();
    }

    private function showCreate(): string
    {
        $departments = $this->department->getDepartments();

        $html =  '
            <div class="w-96 mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <form class="flex flex-col box-border" action="index.php" method="post">
                    <label for="firstname" class="block text-md my-1 font-medium">Vorname</label>
                    <input
                            id="firstname" type="text"
                            name="firstname"
                            class="border-b-2 border-black px-1 h-8 focus:outline-none"
                            placeholder="Vorname"';

        if (strlen($this->id) !== 0){
            $html .= 'value="'. $this->employee->getById($this->id)['firstname'] . '"';
        }

        $html .=   '>
                    <label for="lastname" class="block text-md mt-5 font-medium">Nachname</label>
                    <input
                            id="lastname" type="text"
                            name="lastname"
                            class="border-b-2 border-black px-1 h-8 focus:outline-none"
                            placeholder="Nachname"';

        if (strlen($this->id) !== 0){
            $html .= 'value="'. $this->employee->getById($this->id)['lastname'] . '"';
        }

        $html .=   '>
                    <label for="gender" class="block text-md mt-5 font-medium">Geschlecht</label>
                    <input
                            id="gender" type="text"
                            name="gender"
                            class="border-b-2 border-black px-1 h-8 focus:outline-none"
                            placeholder="Geschlecht"';

        if (strlen($this->id) !== 0){
            $html .= 'value="'. $this->employee->getById($this->id)['gender'] . '"';
        }

        $html .=   '>
                    <label for="salary" class="block text-md mt-5 font-medium">Gehalt</label>
                    <input
                            id="salary" type="text"
                            name="salary"
                            class="border-b-2 border-black px-1 h-8 focus:outline-none"
                            placeholder="Gehalt"';

        if (strlen($this->id) !== 0){
            $html .= 'value="'. $this->employee->getById($this->id)['salary'] . '"';
        }

        $html .=   '>
                    <label for="department" class="block text-md mt-5 font-medium">Abteilung</label>
                    <select 
                            name="department_id" 
                            class="border-b-2 border-black h-8 focus:outline-none"
                    >
        ';

        foreach ($departments as $department) {
            $html .= '<option value="'. $department['id'] . '"';

            if (strlen($this->id) !== 0 && $department['id'] === $this->employee->getById($this->id)['department_id']) {
                $html .= 'selected>';
            } else $html .= '>';

           $html .= $department['name'] . '</option>';
        }

        if (strlen($this->id) !== 0){
            $html .= '</select>
                    <input type="hidden" name="id" value="' . $this->employee->getById($this->id)['id'] . '">
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="updateEmp">Update
                    </button>';
        } else $html .= '</select>
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="createEmp">Create
                    </button>';

        $html .= '       </form>
            </div>
        ';

        return $html;
    }

    public function showEmployees(): string
    {
        $employees = $this->employee->getAllEmployees();

        $html = '
            <div class="w-2/3 mx-auto p-7 bg-white shadow-lg shadow-black-500/50">
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
}