<?php
require_once "classes/views/Modules.php";

class DepartmentPage extends Modules{
    public function __construct($api){
        parent::__construct($api);
        $this->isActiveMain = '';
        $this->isActiveEmployee = '';
        $this->isActiveDepartment = $this->activeClass;
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Department page";
    }

    protected function getTop(): string
    {
        return '
            <div class="container mx-auto mb-5">
                <form class="box-border w-64 p-6 border-1 mx-auto shadow-lg shadow-black-500/50 flex flex-col bg-white" action="index.php" method="post">
                    <label for="name" class="block text-md my-1 font-medium">Abteilungsname</label>
                    <input
                            id="name" type="text"
                            name="name"
                            class="border rounded border-slate-400 px-2 h-8">
                    <button class="border w-20 h-7 rounded border-slate-600 bg-gray-200 mt-4 self-end hover:bg-gray-300" type="submit" name="action" value="createDep">Create
                    </button>
                </form>
            </div>
        ';
    }

    protected function getMiddle(): string
    {
        return $this->showDepartments();
    }

    private function showDepartments(): string
    {
        $data = $this->department->getDepartments();

        $html = '
            <div class="container mx-auto">
                <ul class="
                        container mx-auto shadow-lg
                        shadow-black-500/50 p-6
                        w-4/5 md:w-3/6 bg-white
                    "
                >';

        foreach ($data as $i=>$item) {
            $html .= '
                    <li class="flex mx-auto h-8 items-center">
                        <span class="w-8">' . ++$i . '</span>
                        <span class="flex-1">' . $item['name'] .  '</span>
                        <button
                            id="showUpdateDep"
                            class="
                                w-16 mr-1 border rounded
                                border-slate-600 bg-white
                                hover:bg-gray-300 text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                        >Update
                        </button>
                        <button
                            id="deleteDep"
                            class="
                                w-16 border rounded
                                border-slate-600 bg-white
                                hover:bg-gray-300 text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                        >Delete
                        </button>
                    </li>';
        }

        $html .= '</ul></div>';
        return $html;
    }
}