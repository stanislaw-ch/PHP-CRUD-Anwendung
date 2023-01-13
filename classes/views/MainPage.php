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
        $html = $this->showDepartmentsPreView();
        $html .= $this->showEmployeesPreView();
        return $html;
    }

    private function showDepartmentsPreView(): string
    {
        $data = $this->department->getDepartments();

        $html = '
            <div class="container mx-auto w-auto">
                <h2 class="text-center font-bold bg-white mx-auto w-3/5 md:w-2/6 pt-5">Abteilungen</h2>
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-3/5 md:w-2/6 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    private function showEmployeesPreView(): string
    {
        $data = $this->employee->getEmployees();

        $html = '
            <div class="container mx-auto w-auto mt-5">
                <h2 class="text-center font-bold bg-white mx-auto w-6/7 md:w-3/5 pt-5">Mitarbeiter</h2>
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-6/7 md:w-3/5 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center justify-between">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['firstname'] .  '</span>
                        <span class="flex-1">' . $item['lastname'] .  '</span>
                        <span class="flex-1">' . $item['salary'] .  '</span>
                        <span class="flex-1">' . $item['gender'] .  '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}