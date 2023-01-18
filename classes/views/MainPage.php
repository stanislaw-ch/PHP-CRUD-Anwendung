<?php
require_once "classes/views/Modules.php";

class MainPage extends Modules{
    public function __construct($api){
        parent::__construct($api);
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Main page";
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
            <div class="md:w-96 sm:w-96 w-full mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <h2 class="mb-5 text-center text-lg">Abteilungen</h2>
                <ul class="">
                    <li class="flex content-center h-10 text-white bg-slate-700">
                        <span class="flex self-center justify-center w-8">#</span>
                        <span class="flex self-center justify-center flex-1">Abteilung</span>
                    </li>
        ';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="flex self-center justify-center w-8">' . ++$i . '</span>
                        <span class="flex self-center pl-2">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }

    private function showEmployeesPreView(): string
    {
        $data = $this->employee->getEmployees();

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
                <ul class="">
                    <li class="flex content-center h-10 text-white bg-slate-700">
                        <span class="flex self-center justify-center w-8 basis-10 flex-2">#</span>
                        <span class="flex self-center basis-20 flex-1 pl-2">Vorname</span>
                        <span class="
                            flex self-center 
                            pl-2 
                            basis-20 flex-1 
                            ">Nachname</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Geschlecht</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Gehalt</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 hidden sm:flex">Abteilung</span>
                    </li>
        ';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex h-10 border-b border-gray-400 border-dashed">
                        <span class="flex self-center justify-center basis-10 flex-2">' . ++$i . '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2">' . $item['firstname'] .  '</span>
                        <span class="
                            flex self-center 
                            basis-20 flex-1 
                            pl-2 
                            ">' . $item['lastname'] .  '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden">' . $item['gender'] .  '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden">' . $item['salary'] .  '</span>
                        <span class="flex self-center basis-20 flex-1 pl-2 sm:flex hidden ">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}