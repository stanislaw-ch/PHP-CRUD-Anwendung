<?php
require_once "classes/views/Modules.php";

class DepartmentUpdatePage extends Modules{
    private string $id;

    public function __construct($api, $id){
        parent::__construct($api);
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return "CRUD-Anwendung Department update page";
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
                            class="border rounded border-slate-400 px-2 h-8"
                            value="'. $this->department->getById($this->id)['name'] . '"
                    >
                    <input type="hidden" name="id" value="' . $this->department->getById($this->id)['id'] . '">
                    <button class="border w-20 h-7 rounded border-slate-600 bg-gray-200 mt-4 self-end hover:bg-gray-300" type="submit" name="action" value="updateDep">Update
                    </button>
                </form>
            </div>
        ';
    }

    protected function getMiddle(): string
    {
        return $this->department->getTable();
    }
}