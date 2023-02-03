<?php

require_once "src/classes/views/Modules.php";

class MainPage extends Modules
{
    public function getTitle(): string
    {
        return "CRUD-Anwendung Main page";
    }

    protected function getMiddle(): string
    {
        $sr['departmentsTable'] = $this->showDepartmentsPreView();
        $sr['employeesTable'] = $this->showEmployeesPreView();

        return $this->getReplaceTemplate($sr, "home");
    }

    private function showDepartmentsPreView(): string
    {
        $data = $this->department->getAll();
        $html = '';

        foreach ($data as $i => $item) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="flex self-center justify-center w-8">' . ++$i . '</span>
                        <span class="flex self-center basis-20 grow pl-2">' . $item['name'] . '</span>
                        <span class="flex self-center justify-center basis-20">' . $item['count'] . '</span>
                    </li>';
        }

        return $html;
    }

    private function showEmployeesPreView(): string
    {
        $data = $this->employee->getAll();
        $html = '';

        foreach ($data as $i => $item) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="flex self-center justify-center basis-10 flex-2">' . ++$i . '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2">' . $item['firstname'] . '</span>
                        <span class="
                            flex self-center 
                            basis-20 flex-1 
                            pl-2 
                            ">' . $item['lastname'] . '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden">' . $item['gender'] . '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden">' . $item['salary'] . '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden ">' . $item['name'] . '</span>
                    </li>';
        }

        return $html;
    }
}