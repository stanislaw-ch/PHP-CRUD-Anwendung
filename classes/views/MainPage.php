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
                <h2 class="mb-5 text-center font-bold">Abteilungen</h2>
                <ul class="">
                    <li class="flex h-7 border-b border-black">
                        <span class="w-8 text-center border-r border-black">Nr.</span>
                        <span class="flex-1 text-center">Abteilung</span>
                    </li>
        ';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex h-7 border-b border-gray-400 border-dashed">
                        <span class="w-8 text-center border-r border-black">' . ++$i . '</span>
                        <span class="pl-2">' . $item['name'] .  '</span>
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
                <h2 class="mb-5 text-center font-bold">Mitarbeiter</h2>
                <ul class="">
                    <li class="flex h-7 border-b border-black">
                        <span class="basis-10 flex-2 text-center border-r border-black ">Nr.</span>
                        <span class="basis-20 flex-1 text-center border-r border-black">Vorname</span>
                        <span class="
                            basis-20 flex-1 
                            text-center border-r-none 
                            sm:border-r sm:border-black
                            ">Nachname</span>
                        <span class="basis-20 flex-1 hidden sm:inline-block text-center border-r border-black">Geschlecht</span>
                        <span class="basis-20 flex-1 hidden sm:inline-block text-center border-r border-black">Gehalt</span>
                        <span class="basis-20 flex-1 hidden sm:inline-block text-center">Abteilung</span>
                    </li>
        ';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex h-7 border-b border-gray-400 border-dashed">
                        <span class="basis-10 flex-2 text-center border-r border-black">' . ++$i . '</span>
                        <span class="basis-20 flex-1 pl-2 border-r border-black">' . $item['firstname'] .  '</span>
                        <span class="basis-20 flex-1 
                            pl-2 border-r-none 
                            sm:border-r sm:border-black
                            ">' . $item['lastname'] .  '</span>
                        <span class="basis-20 flex-1 pl-2 sm:inline-block hidden border-r border-black">' . $item['gender'] .  '</span>
                        <span class="basis-20 flex-1 pl-2 sm:inline-block hidden border-r border-black">' . $item['salary'] .  '</span>
                        <span class="basis-20 flex-1 pl-2 sm:inline-block hidden ">' . $item['name'] .  '</span>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}