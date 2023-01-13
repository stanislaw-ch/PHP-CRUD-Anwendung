<?php
require_once "classes/views/Modules.php";

class DepartmentPage extends Modules{
    private string $id;

    public function __construct($api, $id = ''){
        parent::__construct($api);
        $this->id = $id;

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
        return $this->showCreate();
    }

    protected function getMiddle(): string
    {
        return $this->showDepartments();
    }

    private function showCreate(): string
    {
        $html = '
            <div class="w-96 mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <form class="flex flex-col box-border" action="index.php" method="post">
                    <label for="name" class="block text-md my-1 font-medium">Abteilungsname</label>
                    <input
                            id="name" type="text"
                            name="name"
                            class="border-b-2 border-black px-2 h-8 focus:outline-none"
                            placeholder="Abteilungsname"';

        if (strlen($this->id) > 0) {
            $html .= 'value="'. $this->department->getById($this->id)['name'] . '">';
            $html .= '<input type="hidden" name="id" value="' . $this->department->getById($this->id)['id'] . '">
                <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="updateDep">Update
                    </button>';
        } else $html .=   '>
                    <button class="w-20 h-7 mt-4 bg-white self-end font-medium uppercase hover:underline hover:underline-offset-4" type="submit" name="action" value="createDep">Create
                    </button>';

        $html .= '      </form>
            </div>
        ';

        return $html;
    }

    public function showDepartments(): string
    {
        $data = $this->department->getDepartments();

        $html = '
            <div class="w-96 mx-auto p-7 mb-5 bg-white shadow-lg shadow-black-500/50">
                <h2 class="mb-5 text-center font-bold">Abteilungen</h2>
                <ul>
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
                        <button
                            id="showUpdateDep"
                            class="
                                w-12 mr-1 ml-auto
                                bg-white hover:underline text-sm
                            "
                            type="button"
                            name="action"
                            data-id="' . $item['id'] . '"
                        >Update
                        </button>
                        <button
                            id="deleteDep"
                            class="
                                w-12 mr-1
                                bg-white hover:underline text-sm
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