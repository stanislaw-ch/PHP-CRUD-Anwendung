<?php
require_once "classes/views/Modules.php";

class EmployeePage extends Modules{
    public function __construct($api){
        parent::__construct($api);
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung";
    }

    protected function getTop(): string
    {
        return '
            <div class="container mx-auto mb-5">
                <form class="box-border w-64 p-6 border-1 mx-auto shadow-lg shadow-black-500/50 flex flex-col bg-white" action="index.php" method="post">
                    <label for="firstname" class="block text-md my-1 font-medium">Vorname</label>
                    <input
                            id="firstname" type="text"
                            name="firstname"
                            class="border rounded border-slate-400 px-2 h-8">
                    <label for="lastname" class="block text-md my-1 font-medium">Nachname</label>
                    <input
                            id="lastname" type="text"
                            name="lastname"
                            class="border rounded border-slate-400 px-2 h-8">
                    <label for="gender" class="block text-md my-1 font-medium">Geschlecht</label>
                    <input
                            id="gender" type="text"
                            name="gender"
                            class="border rounded border-slate-400 px-2 h-8">
                    <label for="salary" class="block text-md my-1 font-medium">Gehalt</label>
                    <input
                            id="salary" type="text"
                            name="salary"
                            class="border rounded border-slate-400 px-2 h-8">
                    <label for="department" class="block text-md my-1 font-medium">Abteilung</label>
                    <input
                            id="department" type="text"
                            name="department_id"
                            class="border rounded border-slate-400 px-2 h-8">
                    <button class="border w-20 h-7 rounded border-slate-600 bg-gray-200 mt-4 self-end hover:bg-gray-300" type="submit" name="action" value="createEmp">Create
                    </button>
                </form>
            </div>
        ';
    }

    protected function getMiddle(): string
    {
        return $this->employee->getTable();
    }
}